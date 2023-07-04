@if ($category === 'tutorials')
    <span class="badge badge--blue">Tutorials</span>
@elseif ($category === 'guides')
    <span class="badge badge--green">Guides</span>
@elseif ($category === 'updates')
    <span class="badge badge--purple">Updates</span>
@elseif ($category === 'personal')
    <span class="badge badge--yellow">Personal</span>
@endif

