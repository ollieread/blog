---
extends: _layouts.archive
section: article
title: An update on what the future has in store for me and ollieread.com
description: "It has been over a year since I last wrote an article on this site, and my god have things changed since then. Well, I'm back with an update on this site, and a look at what the future has in store."
date: 2019-10-03 00:01:00
category: updates
archived: true
---
[[toc]]

It has now been just over a year since I last [published an article](https://ollieread.com/articles/creating-a-modern-day-php-framework) to my site. A lot has changed in both my life, and on this site, as you've probably noticed by now.

The purpose of this article is to give you a glimpse into the future of ollieread.com, as well as give you some information on what I'm working on, and what I will be working on.

# What have I been up to?
The last year of my life has been jam packed, primarily off the back of my daughter being born on the 1st of November 2018. I've been here, just had little time to work on any public content, jumping between client work and being a Dad.

A few months ago my partner, and baby mama joined my company, [Sprocketbox Ltd](https://sprocketbox.io) as a director, and took on her first solo contract. She's absolutely smashing it.

## Sprocketbox
Over the past few months I made the decision to move ollieread.com to be a property of Sprocketbox Ltd, my company. The only thing this will change, besides being able to claim the tax back on ollieread.com related purchases, is that all content released by myself whether premium or open source, will be released under the sprocketbox brand. Essentially, packages will be hosted and released by the sprocketbox [github organisation](https://github.com/sprocketbox).

## The new ollieread.com
You'll have noticed by now that the site has had a complete overhaul, replacing the old pixelart styled design with a cleaner one. There's still a pixelart me sprite, yes I meant sprite, hover over it.

The entire codebase was built from the ground up, all of which is available on [github](https://github.com/ollieread/ollieread.com). The architecture of the new site is very different to the old one, sporting a modular styled approach and utilising actions and operations over controllers and repositories (I'm going to write an article about it).

While the site is still a work in progress, there are 2 notable features. 

### New Comment System
I was previously using Disqus, but I decided to sack that off and write my own. No more JS files injected randomly into the page. The comments support full markdown including [GitHub flavoured markdown](https://github.github.com/gfm/) to help with users trying to debug their code.

### Topics & Versions
You'll notice that all articles now have a list of topics and versions (if they have them, admittedly this one doesn't). This allows me to link content to specific topics and specific versions of supporting software. At the time of writing this it doesn't do much besides display, but I'm working on the ability to filter by both of these, allowing you to find content that matches exactly what you need.

# What am I working on?
Besides client work and this site, I have been working on, and will be working on, a whole bunch of content.

## Courses
As you may have seen, I have been working on a course called [Multitenancy with Laravel](https://ollieread.com/articles/multitenancy-with-laravel-a-course-and-package). 

You may be familiar with the [Kitchen Sink Academy](https://kitchensink.academy), a subscription based course/lesson service that I announced, stupidly, not long before my daughter was born. This is still in the works, and something I'll be jumping straight back into once I've finished Multitenancy with Laravel.

These are the only courses I have planned right now, but I definitely want to look into the possibility of creating more in the future.

## Articles
I have a whole wall of post-it notes listing many topics that I'm going to write about. Many of these planned topics/articles will make use of a new feature I'm working on, called Article Series. This feature will let me break the articles down into smaller articles, linking together under one overarching series, hopefully making it more digestable.

In the near future I'll be announcing a release schedule for content, with the aim to publish a new article every X days/weeks/months.

Below is a brief look at some of the articles I have planned.

### Actions & Operations
A writeup on the way I approached this site, dumping the old controller and repository for something akin to command queries, but not as restrictive.

### APIs with Laravel
A series covering the creation of RESTful APIs with Laravel.

**Descriptive HTTP Methods** <br /> _Using HTTP methods to more appropriately describe the request._

**Descriptive HTTP Status Codes** <br /> _Using HTTP status codes to more appropriately describe the response._

**Utilising HTTP Headers** <br /> _Turbocharging your API by utilising HTTP headers to their fullest potential._

### Laravel Authorisation
A series exploring all of the different options for authorising users in Laravel.

**RBACs** <br /> _A look into role based access control and how we can implement it with Laravel. (An update of [my previous article](https://ollieread.com/articles/laravel-rbac-role-based-access-control-without-over-engineering))._

**ACLs** <br /> _A look into access control lists, specifically Laravels policies, and how we can implement them._

**Bitwise Permissions** <br /> _A look into how we can store a combination of up to 64 different permissions as a single 64 bit integer. (This site uses bitwise permissions)_

**Custom Gate** <br /> _Sometimes Laravels default Gate doesn't cut it, lets see what we can do to change that._
  
### Design Patterns 
A look into some common design patterns, from a purely PHP approach, including but not limited to:

  - Pipeline Pattern
  - Builder Pattern
  - Repository Pattern
  - Service Container Pattern
  - Singletons
  - Factory Pattern
  - Proxy Pattern
  - Facades & Service Locator Pattern

## Packages
I've also got a number of packages in the works, for use on my own projects but also for release.

### Premium
**Porter** <br />_The multitenancy package._

**Overseer** <br />_The Nova alternative._

### Open Source
**Forerunner** <br />_Improved blade components and prototyping tools._

**Auth+** <br />_An overhaul of Laravels authentication system._

**Eloquent+** <br />_An extension of Laravel Eloquents functionality._

**Database+** <br />_Goes hand in hand with Eloquent+._

**Matter** <br />_The successor to Articulate._

**Contraption** <br />_A whole bunch of component packages that nicely slot together as a framework._

# Have something to add?
The content I write on my site, though partly for me, is mostly for you. If there's something in particular you'd like to see covered, something you'd like addressed, whether it's an idea for a course, article or package, please get in touch. You can reach me on [twitter @ollieread](https://twitter.com/ollieread) or join [the discord](https://discordapp.com/invite/k7yUccq).

Cover image by <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@matt_wojtas?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Matt Wojtaś"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Matt Wojtaś</span></a>