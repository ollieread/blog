---
extends: _layouts.archive
section: article
title: The Action and Operation approach
description: "For a long time, I followed the approach of creating controllers and repositories for individual entities (models). While this approach works, it slowly started to leave a bad taste in my mouth. After much researching into alternative approaches I was unable to find something that truly fit what I wanted. So I decided to have a go at creating my own."
date: 2019-10-07 13:00:00
category: guides
archived: true
---
The action and operation approach is one that I recently came up with while trying to solve my never-ending quest for the tidiest code. I imagine that I am not the first person to come up with this solution, and there very well may be some obscure design pattern out there, but I couldn't find it.

This article is to serve as a write up about the pattern, and how I came to discover it. 

:::info
Rather than constantly writing `Action and Operation`, I'll be referring to it as `A&O`, or simply `The pattern` for the duration of this article.
:::

[[toc]]

# Introduction
The pattern is intended as an alternative to the standard controller and repository approach, by creating code more specific to its purpose. You end up creating more files, but overall it's easier to navigate. 

But before we can really get into the nitty gritty we need to define what exactly actions and operations are.

## Actions
Actions are essentially more streamlined controllers with a single purpose. They're pretty simple and nothing special, in fact, you're probably already familiar with the idea of 'single action controllers', which isn’t a million miles away from these kind of actions.

With the A&O approach an action is the specific end-goal of the routes, so you'd have a single action with a `create` and `store` method. The reason for this is that the `create` method only exists to provide a form to submit data to the `store` method. They're two sides to the same coin.

### Example Action
If you want to see an example, check out the [action](https://github.com/ollieread/ollieread.com/blob/master/app/Articles/Actions/Article.php) that handles this page. Feel free to browse around and look at the others.

## Operations
Operations are a little more complex than actions, but not hugely. The idea behind them is that they represent a particular operation within your system, including all of the ways that operation can be performed. 

Operations in essence are fluent builders, allowing you to daisy-chain a series of setters before calling a `perform` method, that will return the result. 

### Example Operation
Example operations would be `CreateArticle`, `GetArticle` and `GetArticles`, all of which are reused. These particular examples are operations this site uses, with `GetArticles` being used on the [articles](/articles), [version](/articles/version/laravel-6.x), [category](/articles/category/tutorials) and [topic](/articles/topic/laravel) pages.

If you want to see the example, check out the [operation](https://github.com/ollieread/ollieread.com/blob/master/app/Articles/Operations/GetArticle.php) on GitHub.

# Comparison
Now that I've defined actions and operations, let’s look at how they stack up against other approaches.

:::info
All of the examples here are based on a standard non-api project build, and the number of actions required for each example would be less if creating an API.
:::

## Actions vs Controllers
To compare the two, let’s take a look at the following example Laravel controller.

```php
namespace App\Http\Controllers;

class ArticleController extends Controller {
    public function index() { // ... }
    public function view() { // ... }
    public function create() { // ... }
    public function store() { // ... }
    public function edit() { // ... }
    public function update() { // ... }
    public function delete() { // ... }
    public function destroy() { // ... }
}
```

Each method represents an endpoint or route, and with the exception of `view` and `index` they're paired up. These sort of controllers can grow quickly requiring a lot of abstraction, typically repositories, which can make navigating a codebase confusing.

Now, if we were to take this controller and create actions for it, we'd create the following:

- `Articles\Index` - An invokable class with a single `__invoke` method that handles the article listing.
- `Articles\View` - An invokable class with a single `__invoke` method that handles viewing a particular article.
- `Articles\Create` - Essentially a smaller controller containing only the `create` and `store` methods.
- `Articles\Edit` - Similar to `Create` but with the `edit` and `update` methods.
- `Articles\Delete` - The same again but with `delete` and `destroy`.

We’ve taken the controller and broken the methods up, abstracting them out into a class that represents their action. We have a few more classes here, but we can immediately identify the class responsible for a particular action, and because of the logical grouping, we know everything in `Articles\Create` is relevant to the creation of articles.

You’ll also notice that I defined two types of actions above, both of which are easy to register with Laravels router.

```php
$router->get('/articles', Article\Index::class);
$router->get('/create', [Article\Create::class, 'create']);
$router->post('/create', [Article\Create::class, 'store']);
```

## Actions vs Single Action Controllers
Single action controllers, if you aren’t familiar, are simple classes with an `__invoke` method. Following on from the above example, the single action controller approach would require the creation of 8 separate classes.

- `Articles\Index` - An invokable class with a single `__invoke` method that handles the article listing.
- `Articles\View` - An invokable class with a single `__invoke` method that handles viewing a particular article.
- `Articles\Create` - An invokable class with a single `__invoke` method that handles the displaying of the create article form.
- `Articles\Store` - An invokable class with a single `__invoke` method that handles the processing of the create article form.
- `Articles\Edit` - An invokable class with a single `__invoke` method that handles the displaying of the edit article form.
- `Articles\Update` - An invokable class with a single `__invoke` method that handles the processing of the edit article form.
- `Articles\Delete` - An invokable class with a single `__invoke` method that handles the displaying of the delete article confirmation page.
- `Articles\Destroy` - An invokable class with a single `__invoke` method that handles the confirmation of the article deletion.

While that is only 3 more than we would create using my action definition, we’ve also made it harder to follow, as the classes responsible for creating an article are actually split across two classes. Chances are, we’re going to be jumping between the two when doing work, to make sure changes are present in both.

The benefit of my approach to actions here is the readability of the code and the logical grouping.

## Action Conclusion
The pros of using my proposed approach are:

- Makes the code more readable.
- Helps prevent the creation of huge controllers.
- Groups methods/routes logically.
- Follows the single responsibility principal to a sensible level.

And the cons of using my proposed approach are:

- Requires more classes than using a single resource controller.
- Actions that can be performed ona resource are split across multiple classes.

Since the number of classes isn’t an issue on modern systems or using modern editors, and it’s a general rule to avoid creating huge mammoth classes, I think it’s fair to say that the pros vastly outweigh the cons.

## Operations vs Inline
Whether you're using operations or not, performing things like querying the database inline is less than ideal, especially if it's a process that repeats itself with little to no changes.

As I mentioned previously, the `GetArticles` operation for this site is used on 4 public pages, plus the RSS feed, the sitemap and the admin area. If you had a codebase that had the same requirements, you'd find that you have a whole bunch of repeating code. 

The base query for returning articles, on the primary listing page would look like this:

```php
Article::query()
    ->where('post_at', '<=', Carbon::now())
    ->where('active', '=', 1)
    ->where('status', '=', Status::PUBLIC)
    ->paginate(20);
```

If we wanted to retrieve only articles that belong to a particular category we’d need to copy the above and add the following `whereHas` clause.

```php
$query->whereHas('category', function (Builder $query) use($category) {
    $query->where('id', '=', $category->id);
})
```

We’d repeat the same process for topics and versions, with the relationship names changed appropriately.

Creating an operation here would abstract that query out to a single place, allowing you to change the query everywhere at once.

```php
$articles = (new GetArticle)->perform();
```

Then when I want to query for category, version or topic articles, I can just add `setCategory($category)`, `setTopic($topic)` or `setVersion($version)` before the `perform()` method. 

If we were to need something that requires configuring we’d add another setter. That would require us to modify the code calling the operation, but if you’re using a modern IDE, finding usages of a particular class is a trivial process. 

My operations are typically quite descriptive, and simply act as a layer of abstraction as well as simplification. Due to this, I do actually provide all of the values using setters. You may think that this isn’t at all that different to doing it inline, but each of my setters that adds a single value, could possibly expand out into some more complex code.

Here’s my usage of the operation:

```php
$articles = (new GetArticles)
            ->setActiveOnly(true)
            ->setStatuses(Status::PUBLIC)
            ->setPaginate(true)
            ->setLimit(20)
            ->perform();
```

## Operations vs Repositories
Repositories are a totally valid method of abstraction and can be used with Eloquent, regardless of what others may say, and for the longest time I championed this pattern. 

Over time I found myself having to create many different methods for all the uses cases, while trying to avoid requiring 10s of arguments being passed, which required me to abstract out to yet more methods to avoid repeat code.

My first step away from repositories was to introduce the concept of Criteria, which were essentially eloquent scopes but not tied to specific models. Think along the lines of the following:

```php
$repository->with(new ActiveOnly, new Published)->getArticles(20);
```

This was all well and good but I soon hit a point where I needed criteria that was aware of other criteria, which is actually the point where I came up with operations, by taking my criteria and making my criteria the operation.

This site actually allows me and other admins to view inactive and non-public articles, adding two possible conditions to the querying of articles. Ignoring the concept of criteria for a minute, let’s take a look at what my particular use-cases could look like when using repositories.

```php
public function getArticles(int $limit, bool $active, int $status);
public function getCategoryArticles(Category $category, int $limit, bool $active, int $status);
public function getTopicArticles(Topic $topic, $limit, bool $active, int $status);
public function getVersionArticles(Version $version, $limit, bool $active, int $status);
```

There are obviously many ways that you could write these methods, as in my first example I created 8, the 4 you see above plus 4 prefixed with `getPublished`. 

However you decide go about this, you will typically find yourself with one of the following:

- A huge method that handles all cases, with many arguments, and is pretty much the only public method on the repository.
- Several smaller methods that have basically the same code with very slight differences.
- Many smaller methods that mostly abstract out the logic to avoid repeat code (The Taylor approach I call this), but doing nothing but filling the class with arguably unnecessary methods.

Now let’s take a look at my [`GetArticles`](https://github.com/ollieread/ollieread.com/blob/master/app/Articles/Operations/GetArticles.php) operation. It's 290 lines long, with only 86 of those handling the actual logic. The rest are docblocks, setters or blank-lines. This class has 9 used properties with their own setters.

- `activeOnly` - A flag denoting whether or not to only query for active articles.
- `statuses` - An int array containing the statuses to query for.
- `limit` - The amount of articles to return.
- `category` - The category that the articles should belong to.
- `topics` - A collection of topic models that the articles should have assigned.
- `versions` - A collection of version models that the articles should have assigned.
- `series` - The series that the articles should belong to (not actually used right now).
- `paginate` - Whether or not to paginate the results, if true the limit is used, otherwise it's a non paginated limited response.
- `liveOnly` - A flag denoting whether the articles should have a `post_at` of less than now.

This operation allows me to get the same results as the 4 example repository methods I defined above, as well as many other combinations as are possible. 

It should also be noted that this operation is arguably my most complex, with `GetTopics` being 134 lines comprising of a 29 line long method (including definition and braces), 6 properties and 6 setters. You can see that operation [here]((https://github.com/ollieread/ollieread.com/blob/master/app/Articles/Operations/GetTopics.php))

## Operations vs Services
Services are in essence similar to repositories, and would fall foul of the same problems mentioned above. 

You could however, create a stateful service that has a builder like interface, allowing you to build up your requirements before retrieving the result. In that instance, you’ve basically created an operation. I think the distinction here is primarily that my operations follow a standard pattern, if not an interface, and only perform a single operation, albeit in multiple different ways.

There’s not much more to add here, as operations are arguably very specific services.

## Operations vs Model Methods
The biggest problem with adding model methods is that Eloquent models already have an insane amount of methods inherited from the parent model and its boatload of traits. Adding more is really going to complicate things, especially if you want decent tab completion in your IDE.

Model methods would also find itself caught by the same pitfalls as repositories and services. By the time you’d created methods that allowed for all the combinations that my operation allows you’d have as many methods and calls as would be required by just doing it [inline](#operations-vs-inline).

## Operations Conclusion
The pros of using my proposed approach are:

- Provides a level of abstraction for your application and/or business logic.
- Typically requires less code.
- More flexible than creating methods for each use case, when in a model, service or repository.
- Reusable.
- Isn’t limited specifically to database interactions.
- Fluent builder interface is easier to follow and use compared to method arguments.
- Follows the single responsibility principal.

The cons of using proposed approach are:

- Adding extra options in still requires you finding all references and updating accordingly.
- The classes appear far larger than they are in truth.

Operations are clearly easier to follow and easier to work with, outweighing the cons.

# Command Query Separation
Command Query Separation, or [CQS](https://en.wikipedia.org/wiki/Command%E2%80%93query_separation) is a design pattern not entirely dissimilar to that of my operations approach. The biggest difference is that it splits up what I would consider operations into commands and queries, and the specific rules about these are something I didn’t get along with.

## Commands
Commands in CQS are write operations, that return no result. They are permitted to throw exceptions, and since using exceptions to control the flow of the system is typically frowned upon, that was of little use. 

If this is the first time you’re hearing of CQS, you’re probably asking “Why on earth would I not want a result?”, which is a question I’m still asking myself. I believe that the general practise here would be to use a query after a command, to query the result.

By all means take a read of the CQS pattern and see if you can see something that I missed. I’d be more than happy to hear a sensible argument for this approach.

## Queries
Queries in CQS are the opposite of commands, performing only read operations and returning the result. Queries can be used by commands, but cannot use commands. I can definitely think of many times where this would be fine and I could live with the few where it wouldn’t.

## So why not CQS?
My conclusion with CQS was that it would require the creation of far more classes than my operations approach, definitely more than the obvious 2x, and afford less flexibility without thinning the lines between what is acceptable and what is not.

My operation solution combines the two into one, and can in theory return no result like a command, but it’s probably best to always return something.

Perhaps it’s my understanding of CQS, or lack thereof, but I really don’t see the benefit at all. If you’re a champion of this pattern, or someone with an eye on something that I can’t see, I’d love to hear from you.

# Conclusion
I tried to approach this topic objectively for this article, and I’ll be the first to admit that I am most probably biased, but I genuinely believe in this approach, not just from the theory, but the practicality of it too.

The purpose of this article was to share with you this approach, and try to explain how I came up with this, as well as offer all of the information to you so that you can make your own decision, and/or give me feedback.

If you’ve got questions about this, criticism on the approach, or even if you want to inform me that this pattern already exists and is definitely not something I coined, I’d love to hear from you. You can contact me on [twitter](https://twitter.com/ollieread), [discord](https://discordapp.com/invite/k7yUccq) or in the comments below.

I hope you enjoyed this article.