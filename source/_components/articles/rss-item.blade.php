<entry>
    <id>{{ $entry->getUrl() }}</id>
    <link type="text/html" rel="alternate" href="{{ $entry->getUrl() }}" />
    <title>{{ $entry->title }}</title>
    <published>{{ date(DATE_ATOM, $entry->date) }}</published>
    <updated>{{ date(DATE_ATOM, $entry->date) }}</updated>
    <author>
        <name>Ollie Read</name>
    </author>
    <summary type="html">{{ $entry->description }}</summary>
    <content type="html"><![CDATA[
        @includeFirst(['_' . $type . '.' . $entry->getFilename(), '_' . $type .'._tmp.' . $entry->getFilename()])
    ]]></content>
</entry>
