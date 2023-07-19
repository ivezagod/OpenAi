<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reveal.js Presentation</title>

    <!-- Reveal.js CSS -->
    <link rel="stylesheet" href="{{ asset('reveal.js/dist/reveal.css') }}">
    <link rel="stylesheet" href="{{ asset('reveal.js/dist/theme/moon.css') }}">

    <!-- Reveal.js plugin CSS -->
    <link rel="stylesheet" href="{{ asset('reveal.js/plugin/highlight/monokai.css') }}">
</head>
<body>
<div class="reveal">
    <div class="slides">
        <section data-markdown>
            <textarea data-template>
            <!-- Your slides will be inserted here -->
            {!! $presentation->content !!}
             </textarea>
        </section>
    </div>
</div>

<!-- Reveal.js library -->
<script src="{{ asset('reveal.js/dist/reveal.js') }}"></script>

<!-- Reveal.js Markdown plugin -->
<script src="{{ asset('reveal.js/plugin/markdown/markdown.js') }}"></script>

<!-- Reveal.js Highlight plugin -->
<script src="{{ asset('reveal.js/plugin/highlight/highlight.js') }}"></script>

<script>
    // Initialize reveal.js
    Reveal.initialize({
        plugins: [ RevealMarkdown ],
        dependencies: [
            {
                src: '{{ asset('reveal.js/plugin/markdown/markdown.js') }}', condition: function () {
                    return !!document.querySelector('[data-markdown]');
                }
            },
            {
                src: '{{ asset('reveal.js/plugin/highlight/highlight.js') }}', async: true, callback: function () {
                    hljs.initHighlightingOnLoad();
                }
            }
        ]
    });


</script>
</body>
</html>
