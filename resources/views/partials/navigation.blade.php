<!--Navbar-->
<style>
    .navbar-brand img{
        width: 50%;
    }
</style>
    <nav class="customMainNav navbar navbar-expand-lg navbar-dark primary-color">
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="/">
                <img src="/img/logo.png" />
            </a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="@if(request()->path() == '/') active @endif  nav-item">
                        <a class="nav-link" href="/">Home </a>
                    </li>
                    <li class="@if(request()->path() == 'catalogs') active @endif nav-item">
                        <a class="nav-link" href="/catalogs">Catalogs</a>
                    </li>
                    <li class="@if(request()->path() == 'stores') active @endif nav-item">
                        <a class="nav-link" href="/stores">Stores</a>
                    </li>
                    <li class="@if(request()->path() == 'blog') active @endif nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>

                </ul>
                <!-- Links -->
            </div>
            <!-- Collapsible content -->
        </div>
    </nav>
<!--/.Navbar-->
