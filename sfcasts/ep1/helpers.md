# Business Logic Helpers

We've already been organizing our code in several ways. The biggest way
is that we've been breaking our components down into smaller pieces, which is
*awesome*! We also created services for fetching data, whether that's via
AJAX calls or by grabbing a global variable.

But these aren't the only ways we can organize our code. In
JavaScript, like with most languages, if you have a chunk of code that's
complex or that you want to reuse, you can *totally* isolate that into its own
file. This is *exactly* what we often do in Symfony with service classes.

## Why Isolate Logic?

Look at `product-card.vue`. We created a computed property that
takes the product's price, divides it by a hundred and then converts it into
decimal digits to display in the template.

Having logic inside your components is a bit like having logic inside of controllers
in Symfony. It's not the *worst* thing ever, but it makes your controllers harder
to read. It also means that you can't reuse that code from *other* parts of your
app *or* unit test it.

The same is true in JavaScript. By isolating logic like this into a separate
file, we can keep our components readable, re-use logic and, if you want, unit
test it.

But... I'm not going to put this logic into the `services/` directory because,
at least in this project, I'm using `services/` to mean "things that fetch data".
In functional programming, a `helper` is a term that's often used for functions that
take input, process it and return something else. And *this* is *exactly*
what our new function will do.

## Create a Helper Function

So, inside of `js/`, create a new directory called `helpers/` and then a new
file called `format-price.js`. In here, `export default` and, actually, let's
use the more *hipster* arrow syntax to say that I `export default` a function.

[[[ code('fcc532af41') ]]]

For the body of that function, go to `product-card`, copy the formatting code
and... paste. But change to use the `price` argument.

[[[ code('a2b33eba40') ]]]

Brilliant! Now, you might notice that ESLint is *angry*. Does it NOT like
hipster code? How *dare* you, ESLint? Oh, no! Phew...! It says

> Unexpected block statement surrounding arrow body. Move the return value
> immediately after the arrow.

My ESLint rules are set up so that if I have an arrow function that only has
*one* line, and that one line a return statement, we should add parentheses around
the statement then remove the `return` and the semi-colon at the end.

[[[ code('d3eec7fb8c') ]]]

That's now an *implied* return.

If you don't like that, just use the normal function syntax. And, to earn the
admiration of our teammates, let's add some JSDoc: the price is a number and
let's even describe what the function does.

[[[ code('8606aa76e4') ]]]

And... woo! We now have a *nice* reusable function! Oh, and there are two ways to
organize your helpers... or JavaScript modules in general.
First, you can have a file, like `format-price`, which
exports `default` a *single* function. *Or*, if you have *several* different
helper functions related to pricing or number manipulations, you could create a
file called, maybe, `number.js` and then export *named* functions. That second
idea is what we're doing inside of `services/`. It's up to you to decide which
you like better.

## Using the Helper Function the Wrong Way

Ok! Let's go use this inside of `product-card.vue`.
The first thing we need to do is import it into the
component. Do that with `import formatPrice from '@/helpers/format-price'`

[[[ code('05b531dd6e') ]]]

Now, when I *first* started using Vue, I thought:

> Hey! I now have a local variable called `formatPrice` in this file! So
> let's go right up to the template and use it! `formatPrice()` with
> `product.price` to reference the `product` object and its `price` property.

[[[ code('44008f3a72') ]]]

But... it was not to be! If you move over to the browser's console...
our dreams are crushed! It says:

> Property or method `formatPrice` is not defined on the instance, but referenced
> during render.

Of course! When you reference a variable or function in a template
we know that what it *really* does is call `this.formatPrice()`. It does *not*
try to find some local `formatPrice` variable. On our instance, we *do* have a
computed property called `price` but no methods.

## Using the Helper in our Component code

So... we *can't* just import `formatPrice` and expect it
to magically be available in the template. But we *can* use it in our JavaScript
code, like in our computed property.

Change the template code back to `price`. *Now*, in the computed method,
use the new helper: `return formatPrice()`, and pass the same
thing we did before: `this.product.price`.

[[[ code('771884b978') ]]]

*This* time, when we move over... yes! It works perfectly! Let me get rid of the
search term and... nice! No errors in the console.

Next: Let's make our search bar a *little bit* fancier by adding an X icon
on the right to clear the search!
