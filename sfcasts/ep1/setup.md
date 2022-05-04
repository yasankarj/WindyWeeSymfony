# Encore, Symfony & API Platform

Well hey friends! Welcome to the Delightful world of Vue.js. I know I say that
*every* topic we cover at SymfonyCasts is fun - and I *totally* mean that - but
this tutorial is going to be a *blast* as we build a *rich* and realistic JavaScript
frontend for a store.

## React vs Vue

These days, the two leaders in the frontend-framework world seem to be React and
Vue.js. And just like with PHP frameworks, they're *fundamentally* the same: if
you learn Vue.js, it'll be much easier to learn React or the other way around.
If you're not sure which one to use, just pick one and run! React tends to feel a
bit more like pure JavaScript while Vue has a bit more magic, which, honestly,
can make it easier to learn if you're not a full-time JavaScript developer.

## Vue 2 vs Vue 3

In this tutorial, we'll be using Vue version 2. But even as I'm saying this, Vue
version 3 is nearing release and might already be out by the time you're watching
this. But don't worry: there are actually very few differences between Vue 2 and 3
and whenever something *is* different, we'll highlight it in the video. So feel
free to code along using Vue 2 or 3.

## Project Setup

Oh, and speaking of that, to get best view of the Vue goodness - I had to get *one*
Vue pun in - you *should* totally code along with me: you can download the course
code from this page. After unzipping it, you'll find a `start/` directory with the
same code that you see here. Follow the `README.md` file for all the fascinating
details on how to get your project set up. The code *does* contain a Symfony app,
but we'll spend most of our time in Vue.

One of the last steps in the README will be to find a terminal, move into the
project and use Symfony's binary to start a local web server. You can download
this at https://symfony.com/download. I'll say: `symfony serve -d` - the `-d`
tells it to start in the background as a daemon - and then also `--allow-http`:

```terminal-silent
symfony serve -d --allow-http
```

This starts a new web server at localhost:8000 and we can go to it using `https`
or `http`. We'll talk about why I used the `--allow-http` flag later.

Copy the URL, find your browser, paste it in the address bar and... say hello
to a giant error!

## Yarn & Webpack Encore Setup

Let's... back up. There are two things you need to know about our project. First,
to help process JavaScript and CSS, we're using Webpack Encore: a simple tool
to help configure Webpack. We have an entire
[free tutorial](https://symfonycasts.com/screencast/webpack-encore) about it and
you'll probably want to at *least* know the basics of Webpack or Encore before you
keep going.

Our Encore config is pretty basic, with a single entry called `app`.
It lives in the `assets/` directory - that's where all of our frontend files will
live. The `app.js` file doesn't actually *have* any JavaScript, but it *does* load
an `app.scss` file that holds some basic CSS for our site, including Bootstrap.
Our base layout already has a `link` tag to the built `app.css` file...
which exploded because we haven't executed Encore and *built* those assets yet.

Back at your terminal, start by installing Encore and our other Node dependencies
by running:

```terminal
yarn install
```

If you don't have `node` or `yarn` installed, head to https://nodejs.org and
https://yarnpkg.io to get them. You can also use `npm` if you want. Once this is
done populating our `node_modules/` directory, we can run Encore with:

```terminal
yarn watch
```

This builds the assets into the `public/build` directory and then waits and watches
for more changes: any time we modify a CSS or JS file, it will automatically
re-build things. The `watch` command works thanks to a section in my `package.json`
file: `watch` is a shortcut for `encore dev --watch`.

Ok! Let's try the site again - refresh! Welcome to MVP Office Supplies! Our
newest lean startup idea here at SymfonyCasts. Ya see, most startups take a
lot of shortcuts to create their first minimum viable product. We thought:
why not take that *same* approach to office furniture and supplies? Yep, MVP
Office Supplies is all about delivering low-quality - "kind of" functional - products
to startups that want to *embody* the minimum-viable approach in all parts of their
business.

## Traditional Symfony App Mixed with Vue

Everything you see here is a traditional Symfony app: there is *no* JavaScript
running on this page at all. The controller lives at
`src/Controller/ProductController.php`: `index()` is the homepage and it renders
a Twig template: `templates/product/index.html.twig`. Here's the text we're seeing.

The point is: right now, this is a good, traditional, boring server-side-generated
page.

## API Platform API

The second important thing about our app is that it already has a really nice API.
You can see its docs if you go to https://localhost:8000/api. We built this with my
*favorite* API tool: API Platform. We have several tutorials on SymfonyCasts
about it.

Inside our app - let me close a few files - we have 6 entities, or database tables:
`Product`, `Category` and a few others we won't worry about in this tutorial. Each
of these has a series of API endpoints that we will call from Vue.

For example, back on the browser, scroll down to the `Product` section: we can
use these interactive docs to *try* an endpoint: let's test that if you make a
request to `/api/products`, that will return a JSON collection of products. Hit
Execute and... there it is! This funny-looking JSON format is called JSON-LD, it's
not important for Vue - it's basically JSON with extra metadata. Under the
`hydra:member` property, we see the products: a useful Floppy disk and some blank
CD's - all kinds of great things for a startup in the 21st century.

We'll be using this API throughout the tutorial.

Ok, click back to the homepage. Next, let's get Vue installed, bootstrap our first
Vue instance and see what this puppy can do!
