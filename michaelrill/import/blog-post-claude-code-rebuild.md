# How I Used Claude Code to Rebuild My Website

I've had a website for a while. It was functional, it looked fine, and I mostly ignored it. But earlier this year I decided to rebuild it from scratch — not with a page builder, not with a starter theme, and not by hiring a developer. I wanted to see how far I could get using Claude Code as my collaborator.

The short answer: further than I expected.

## Why rebuild at all

The old site did its job, but it didn't feel like mine. It was a theme I'd tweaked until the tweaks were fighting each other, and the result was something that worked but had no point of view. I wanted a classic WordPress theme — no block editor dependencies, no plugin soup — that reflected how I actually think about design: clean, typographic, and opinionated about the things that matter.

I also wanted to learn something in the process. I've been around code long enough to know what I want but not always how to get there in CSS. Claude Code changed that equation.

## How the process worked

I didn't hand over a spec and wait. This was a conversation — iterative, sometimes messy, always moving forward. I'd describe what I wanted, Claude would build it, I'd look at the result and say "the labels are too low" or "the sun icon looks weird in Safari," and we'd go back and forth until it was right.

Some sessions were focused: implement dark mode. Others were exploratory: "do you have ideas for how to improve the site?" Claude would suggest a handful of things — a 404 page with personality, reading time estimates, a Now page — and I'd pick the ones that resonated.

The back-and-forth felt more like working with a sharp junior developer who happens to have perfect recall than like using a tool. I'd push back, Claude would adjust. I'd share screenshots of rendering bugs, Claude would dig into the markup. We went through probably a dozen rounds on the Bigfoot footnote styling alone.

## What we built

The theme is a classic WordPress theme built on a two-column grid: 20% left column for metadata, 80% right for content. That layout is the backbone — it runs through blog posts, pages, the About timeline, the Now page, everything.

**Typography and design tokens.** Manrope as the primary font, Fira Code for monospace, both self-hosted as variable fonts. Every color, spacing value, and font size lives in CSS custom properties, which made dark mode possible without rewriting half the stylesheet.

**Dark mode** was one of the bigger lifts. It detects your OS preference, falls back to time-based switching (dark after 8pm, light after 7am), and lets you override with a toggle. There's an inline script in the `<head>` that sets the theme before the page renders, so you never get a flash of the wrong mode. The toggle itself went through a few iterations — I started with text glyphs for the sun and moon icons, but they rendered differently across browsers. We ended up with inline SVGs for consistency.

**The About page** uses a timeline layout for my career history, and the **Now page** uses the same two-column structure for what I'm currently up to. Both started as hardcoded PHP — which obviously defeats the purpose of having a CMS — and were later refactored into custom post types with WordPress XML import files for the initial content. That XML approach was one of my favorite parts of the process: Claude generated pre-populated import files that I could load directly via Tools → Import → WordPress. Fully populated site in seconds.

**Asides** are my version of link posts: short-form notes with a different visual treatment on the homepage but styled like regular posts when you click through. The contact form uses honeypot and time-based spam protection instead of a CAPTCHA plugin. The 404 page has some personality. There's an Easter egg you probably won't find.

**Open Graph meta tags, a favicon derived from the custom logo, RSS with an SVG icon in the footer, reading time estimates, featured images as full-width heroes on single posts** — the kind of details that individually are small but collectively make a site feel considered.

## What I learned about working with AI on a real project

**Iteration is everything.** The first version of almost nothing was the final version. Dark mode took multiple rounds. The mobile menu broke and we fixed it. The footnote plugin styling was a whole saga. That's not a failure of the tool — that's how design works. The difference is that the iteration cycles were fast. Minutes instead of hours.

**Screenshots are worth a thousand prompts.** Whenever I could show Claude what was wrong instead of describing it, we got to the fix faster. "The sun icon looks weird" is vague. A screenshot of asymmetric SVG rays is specific.

**AI is surprisingly good at CSS.** I expected Claude to be strong on logic and structure. I didn't expect it to be good at visual nuance — but it handled things like `clamp()` for fluid typography, `cubic-bezier` easing curves, and `filter: invert(1)` for dark mode logos without much hand-holding.

**You still need taste.** Claude can generate ten ideas for improving your site. It can implement any of them. But knowing which ones to pursue, when to stop iterating, and what "feels right" — that's still yours. I said no to plenty of suggestions and pushed back on implementations that were technically correct but aesthetically off. The tool amplifies your taste; it doesn't replace it.

**The hardcoded content problem is real.** When Claude first built the templates, the content was baked into PHP files. That's fine for a prototype, but it defeats the point of WordPress. Recognizing that and refactoring to custom post types with admin-editable fields was an important step. It's the kind of thing that's easy to skip when you're in the flow of building, but matters the moment you want to update a paragraph without opening a code editor.

## The tools and the craft

I used Claude Code running in the terminal, working directly with the theme files. No plugins beyond the basics (WP-Bigfoot for footnotes). The theme is vanilla WordPress: template hierarchy, custom post types, `wp_head` hooks, `wp_mail` for the contact form. Nothing exotic.

What made this work wasn't any single capability of Claude — it was the sustained context across a long conversation. Claude remembered that I'd raised the mobile breakpoint to 900px. It knew the accent color was `#e91e63`. It understood that when I said "make it match the About page," I meant the specific two-column timeline layout we'd built three sessions ago.

That continuity turned what could have been a frustrating exercise in repeating myself into something that felt genuinely collaborative.

## Would I do it again

Already am. The site you're reading this on is the result, and I'm still tweaking it. That's the thing about building something yourself, even with help — you end up caring about the details in a way you never would with an off-the-shelf theme.

Einfach machen.
