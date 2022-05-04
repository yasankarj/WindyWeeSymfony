# v-on & methods: User Interaction

We've talked a lot about data, props and using those in a template. But what
we *haven't* done yet is add any *behavior*. So here's our next big goal: add
a link to the bottom of the sidebar that, when the user clicks it, will collapse
or expand the sidebar.

## Adding the collapsed Data

Cool! But... where should we start? Let's think about it: in the sidebar template,
we're going to need to know whether or not we are currently collapsed or expanded...
because we will probably need to render different classes or styles to make that
happen. And since this "is collapsed" information is something that will *change*
while our Vue app is running, it needs to live in `data`.

Ok! Inside `data()`, add a new property called, how about, `collapsed`. Set it
`false` so that the component starts *not* collapsed.

[[[ code('0c92aa5838') ]]]

Back on the browser, it doesn't do anything yet, but we *can* see the new data.

Let's update the template to use this. Add a `style` attribute. Basically, if
`collapsed` is true, we'll set a really small width. Of course we can't just start
referencing the `collapsed` variable right now because we need to add the `:` in
front of `:style` to make it dynamic.

To set the width, we *could* put `width:` in quotes then end quote, plus, and 
some dynamic logic that uses the `collapsed` variable. But... yuck! Because the 
`style` attribute can get complex, instead of creating a long string of styles, 
Vue allows us to set this to an object with a key for each style, like `width: '500px'` 
and `margin: '10px'`. In our case, I'll use the ternary syntax: if `collapsed` is true, 
set the width to `70px`, else use `auto`.

[[[ code('f11d3564d8') ]]]

Ok! We have a `collapsed` data and we're using it in the template. Testing time!
In the Vue dev tools, click on Sidebar, change `collapsed` to `true` and...
oh that looks awful! We'll clean that up soon. But it *is* working: the
width dynamically changes.

## Adding the Button

Of course, we're not going to expect users to change the `collapsed` data via
their Vue dev tools. Nope: they'll need a *button* that will change this state.

Back on the template, let's see... after the `<ul>`, I'll add an `<hr>`, a div
with some positioning classes and a button with `class="btn btn-secondary"`.

[[[ code('f95db4ab0f') ]]]

Nothing interesting yet! For the button text, if we're currently collapsed, use
`>>`, else, use `<< Collapse`.

[[[ code('36554a6016') ]]]

Oh ESLint is mad! Hmm, it thinks that the `<` sign is me trying to open an HTML
tag! I could escape this and use `&lt;` - that's probably a great solution! But
as you'll see, Vue will escape this *for* us.

Back on the browser, I'll inspect the new button, and right click to "Edit as HTML".
Yep! Vue automatically escapes any text that you render. That `<` *becomes*
`&lt;` automatically.

## Hello v-text

Oh, and, by the way, when you have an element and the *only* thing inside of it
is some dynamic text - like our button - there is one other way to render that
text. Copy our dynamic code, add a new attribute called `v-text`, set it to
our dynamic code... and delete the curly braces.

Now Vue is happy. `v-text` is the *third* Vue directive that we've seen, after
`v-bind` and `v-for`. It's not a particularly important one... it's just an
alternative way to set the "text" of an element and... it's a *tiny* bit faster.
I mostly just wanted you to see it.

[[[ code('5f1947b634') ]]]

## Adding a new Method

Let's get back to the *real* goal: when the user clicks this button, we need to do
something! Specifically, we need to change the `collapsed` data.

We know that the variables that we have access to in the template are the keys
from `data` and `props`... though we don't have any props in this component. It
turns out that there are a couple *other* ways to add stuff to your template.
One allows you to add *functions*.

Check it out: it doesn't matter where... but I'll do it after `data()`, add a
`methods:` option set to an object. Create a function called
`toggleCollapsed()` and, to start, just say `console.log('CLICKED!')`.

[[[ code('870cb26d28') ]]]

The idea is that, "on click" of this button, we will tell Vue to call this method.

## OnClick with v-on

How... do we do that? By using our *fourth* directive - and a very, very important
one. It's called `v-on`. Inside the `button` element, add `v-on:` and then the name
of the normal DOM event that you want to listen to, so: `click`. Set this to the
name of the *method* that should be called on click: `toggleCollapsed`.

[[[ code('1c3c978bef') ]]]

Yep, the `toggleCollapsed` function is *now* available in the template because
we added it to the `methods` options. PhpStorm even lets you Ctrl or Cmd click
to jump to it!

So... let's try it! Back on your browser, click and... then scroll down. These
errors up here were from when we were in the middle of working. And... yes!
There's our log!

## The v-on Shortcut

`v-on` is one of the *most* important directives and we're going to use it *all*
the time. Scroll up a little to the `:href` attribute. We know that this is
*really* `v-bind` in disguise: `v-bind` is *such* a common directive, that Vue
gives us this special shortcut.

Vue *also* has a shortcut for `v-on`: the `@` symbol. Want to run some code "on
click", use `@click` or `@mouseover` or `@` *whatever* event you want.

[[[ code('cca3f3a4d1') ]]]

## Updating the State

Ok: we have a button and when we click it, it calls the `toggleCollapsed` method.
The *final* step is to *change* the `collapsed` state so that the template updates.
How? `this.collapsed = !this.collapsed`.

[[[ code('2ed974c73b') ]]]

If you were eagerly waiting for some complex & impressive code to change the data,
I'm sorry to disappoint you.

The secret to this working is that any `data` keys are accessible as a *property*
on `this`. In the next chapter, we'll look deeper into how that works. But for now,
it feels good: we change the value of `this.collapsed` and... apparently, Vue
will re-render.

Sound too good to be true? Let's try it! Click the button. It works! Over on the
Vue dev tools, on the `Sidebar` component, we can watch the `collapsed` state change.

And... congratulations! We've now talked about the *core* parts of Vue. Seriously!
To get this working, we added a `collapsed` data, used that in the template, and,
on click, called a `toggleCollapsed` method that we created... which changed the
`collapsed` data. Vue was then smart enough to re-render the template.

We'll see this basic flow over and over again.

But before we do, I want to talk more about how the `this` variable works in
Vue. It's at the *heart* of Vue's magic. And if we understand it, we'll be
just a *little* bit closer to being unstoppable. That's next.
