<!doctype html>

<meta charset=utf-8 />
<title>David Peach's Homepage</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel=stylesheet href=/style.css />
<body>
    <header>
        @if(request()->is('/'))
        <h1>David Peach</h1>
    @else
        <p>
            <a href="/">David Peach</a>
        </p>
    @endif
        <nav>
            <a href="/articles">Articles</a>
            <a href="/notes">Notes</a>
            <a href="/virtual-photography">Virtual Photography</a>
        </nav>
    </header>
    <main>
        <p>Welcome to my new website. If you're reading this, then I have successfully got this site deploying to a Kubernetes cluster in Digital Ocean</p>
        <p>Kubernetes is completely overkill for a blog, but my plan is to build alsorts in this codebase and learn all that I possibly can about the complete development lifecycle.</p>
        <p>I have almost 2,000 old posts that I will be importing very soon.</p>
        {{ $slot }}
    </main>
    <footer>
    </footer>
</body>
