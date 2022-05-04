# Smarter Loading: AJAX status as State

Oh no! The snacks category is *empty*! That's a *huge* problem
on its own! To make things worse, you can't even tell! It looks like it's
loading *forever*... while I'm sitting here getting hungrier and hungrier.

The reason is that, in the `product-list` component, we're showing the loading
animation by checking if the products length is zero.

Using the length of an array to figure out if something is done loading doesn't
really work if it's *possible* that the thing really *can* be empty in some cases!
And that's *totally* the situation we have: sometimes a category *has* no products.
And later when we add a search, sometimes no products will match.

So... the easy solution didn't work. What we need *instead* is a flag that
*specifically* tracks whether or not the products AJAX call is finished.

## Add `loading` to Catalog

We know Catalog is the smart component that takes care of making the
AJAX request. This is means that it is *also* aware of whether or not we are
*currently* making an AJAX call for the products. To track this, let's add a new
data: call it `loading` and set it to `false` by default.

[[[ code('f857b6f274') ]]]

Now, very simply, in `created()`, say `this.loading = true` right before
the AJAX call and, right after, `this.loading = false`.

And *just* like that, we have a flag that we can use to render things based on
the *true* loading status!

[[[ code('91cc26faf9') ]]]

## Try...catch

While we're here, we can *also* add some simple error handling *just* in
case the AJAX call fails. To do that, wrap all of this in a `try...catch` block.
Then, inside `catch`, set `this.loading = false`.

[[[ code('c92c01ff9d') ]]]

If we *really* didn't trust our API... we could add a data called `error`,
change that in catch to a message and render it. But with this, we will *at least*
fail *somewhat* gracefully, and avoid the loader from spinning forever.

As easy as that was, this could be a bit dangerous! The problem right now is
that if *any* of these lines have an error - like if our response doesn't have
a `data` key on it - then the catch will be called and we will *not* show it.
We could be hiding a bug in our code. I *hate* bugs! I think pizza is much better...

So instead, above the try, add `let response`. This simply *declares* the
variable outside of the `try...catch` scope so that it's available in the
entire `created` function. Now, remove the `const` from `response` and then
I'll `return` from the catch. So if we hit the catch, just exit.
Finally, move the `this.products = response.data` code outside of the
catch. Now if *that* line has a problem, it won't be silenced: we'll have to deal
with it!

[[[ code('9c23dd64a5') ]]]

Whether or not you should use the `try...catch` just depends on your situation. I
probably *wouldn't* do this because, if my API endpoint is failing, I have bigger
problems: my site is broken! Giving the user a graceful error is nice, but maybe
I'll save that for V2.

However, if you *do* have a valid situation where an AJAX request might fail - like
if you're *sending* data to the server that might fail validation - then *this*
is how you can catch that error and deal with it. We'll talk about sending data
in the next tutorial.

## Pass `loading` down to `product-list`

Okay, we now have the `loading` data on our smart catalog component. Let's
pass that into the `product-list` component so that we can use it to hide or
show the loading spinner. Split the `product-list` onto multiple lines and
then add `:loading="loading"`.

[[[ code('9548713176') ]]]

And now that we're passing the `loading` prop, in `index.vue`, update the
`props` so we can receive it: add a new `loading` prop with `type: Boolean` and
`required: true`.

[[[ code('894bd5b9fc') ]]]

We can *now* simplify the template: we want to show the loading animation
*if* `loading` is true. And we also want to show these product cards down here, if
we are `!loading`. This second spot isn't *super* important, but it doesn't hurt
to have it!

[[[ code('6ceee4b607') ]]]

## Adding a "No Products" Message after Loading

Time to check things out! Yep! You can *already* see that the snacks page no
longer has the loading spinner. And my other pages work *just* fine.

Well... except it would be even *better* with a "no products found" message!
And now, we can easily add that.

After the `<loading />` component, add an `h5` with a `v-show` directive. This
will hold that "no products found" message... which means that we want it to
show if we are *not* `loading` but `products.length === 0`.

[[[ code('41ae137a33') ]]]

If that's our situation, print a helpful message. And... there it is! Our
snacks page - except for the fact that there are *no* snacks - works great.

## Adding Loading to the Sidebar

The products loading part is now works flawlessly. But there is one other spot that
we're loading with AJAX that does *not* have any loading info: the categories
sidebar!

We're actually going to fix this soon by making the categories load instantly.
But since they *are* still loading via AJAX, let's add the loading component
there as well. Open up `sidebar.vue`: this is the component that makes the
AJAX request for the categories and renders them in its template.

To do this right, should we add another `loading` data like we just did in
catalog? We *totally* could! And that's probably a great option. But... I'm going
to cheat because I know that my app will *never* have zero categories. If that
ever happened, it would probably mean I accidentally emptied my database. Yikes!

Instead, I *am* going to use the `categories.length` to figure out if we're loading.
But to be extra organized, let's do this via a computed property called `loading`.
Inside `return this.categories.length === 0`.

[[[ code('077724819a') ]]]

If there are no categories, then we are loading! The nice thing about using a
computed property is that it will let us use a simple `loading` variable in the
template. And later, if we *did* want to change this to `data`, that would be
*super* easy.

Ok: to use this in the template, first import the loading component:
`import Loading from '@/components/loading'`. Then add the `components` key with
`Loading` inside.

[[[ code('2b83cc6f5f') ]]]

Finally, up in the template, right after the `h5`, we'll say `<loading` with
`v-show="loading"`.

[[[ code('9a4b506d91') ]]]

I love it!

And when we move over to the browser... I'm *hoping* to see the loading animation
right before the categories load. That was super quick! But it *was* there.
We have proper loading on both sides!

Next, I want to start organizing our AJAX calls: we currently make them from inside
of `sidebar.vue` and `catalog.vue`. That's maybe ok, but I'd like to explore a
*better* way to organize these.
