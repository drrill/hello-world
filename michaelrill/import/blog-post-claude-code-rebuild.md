# How I Used Claude Code to Rebuild My Website

I've had a website for a while. It was functional, it looked fine, and I mostly ignored it. But earlier this year I decided to rebuild it from scratch — not with a page builder, not with a starter theme, and not by hiring a developer. I wanted to see how far I could get using Claude Code as my collaborator.

The short answer: further than I expected.

## Why rebuild at all

Back in 2005, I came across Eric Meyer's website and fell in love with the layout: metadata in a narrow left column, main content on the right. Simple, typographic, structured. He's since moved on to different designs, but that two-column idea never left my head.

I've tried to recreate it more times than I'd like to admit. Existing WordPress themes. Tweaking those themes. Building from scratch in the block editor. You name it, I've tried it. But I never fully dug into the details of CSS or the intricacies of the WordPress block editor, and every attempt fell short. They always looked half-baked — lots of big and little kinks in the design that never quite aligned. Over the years I learned to live with it.

Then I read [Miriam Schwab's piece on how she built her new website using Claude Code](https://miriamschwab.me/building-my-wordpress-site-with-claude-ai/). I was fascinated. I'd been around code long enough to know what I wanted but not always how to get there, and here was someone who'd used AI to close exactly that gap. I gave it a try over the Easter weekend.

## How the process worked

So while the sun was shining outside, I sat down for what turned into an intense conversation with Claude about how I wanted the website to look and work. Claude's token limits meant I had to take frequent breaks — even with the smaller Haiku models I'd burn through my allocation quickly. But after a few hours we'd both be back at it, and within a day I had a 95% version up and running.

I didn't hand over a spec and wait. This was iterative, sometimes messy, always moving forward. I'd describe what I wanted, Claude would build it, I'd look at the result and say "the labels are too low" or "the sun icon looks weird in Safari," and we'd go back and forth until it was right.

Some sessions were focused: implement dark mode. Others were exploratory: "do you have ideas for how to improve the site?" Claude would suggest a handful of things — a 404 page with personality, reading time estimates, a Now page — and I'd pick the ones that resonated.

The back-and-forth felt more like working with a sharp junior developer who happens to have perfect recall than like using a tool. I'd push back, Claude would adjust. I'd share screenshots of rendering bugs, Claude would dig into the markup. We went through probably a dozen rounds on the Bigfoot footnote styling alone.

## What we built

The theme is a classic WordPress theme built on that two-column grid I'd been chasing since 2005: 20% left column for metadata, 80% right for content. That layout is the backbone — it runs through blog posts, pages, the About timeline, the Now page, everything. Eric Meyer's influence, twenty years later.

**Typography and design tokens.** Manrope as the primary font, Fira Code for monospace, both self-hosted as variable fonts. Every color, spacing value, and font size lives in CSS custom properties, which made dark mode possible without rewriting half the stylesheet.

**Dark mode** was one of the bigger lifts. It detects your OS preference, falls back to time-based switching (dark after 8pm, light after 7am), and lets you override with a toggle. There's an inline script in the `<head>` that sets the theme before the page renders, so you never get a flash of the wrong mode. The toggle itself went through a few iterations — I started with text glyphs for the sun and moon icons, but they rendered differently across browsers. We ended up with inline SVGs for consistency.

**The About page** uses a timeline layout for my career history — each entry has a date range and company name in the left column and the description on the right. The **Now page** applies the same structure to what I'm currently working on, reading, thinking about. Both are backed by custom post types, so I can edit everything from the WordPress admin without touching a template file.

That wasn't the case initially. Claude's first version hardcoded all the content directly in the PHP templates, which is fine for a prototype but defeats the purpose of having a CMS. When I flagged it, Claude refactored both pages into custom post types — Timeline Entries and Now Items — with meta boxes for date ranges and sort order. Then it generated WordPress XML import files pre-populated with all the existing content. I imported them via Tools → Import → WordPress and had a fully editable site in seconds. That XML approach was one of my favorite parts of the entire process.

**The contact form** was another case where Claude came up with an elegant solution. Instead of adding a CAPTCHA plugin or depending on an external service, we built spam protection directly into the theme: a honeypot field that bots fill in but humans never see, combined with a time-based check that rejects submissions faster than three seconds. Simple, no dependencies, and it works.

**Asides** are my version of link posts: short-form notes with a different visual treatment on the homepage but styled like regular posts when you click through. The 404 page has some personality. There's an Easter egg you probably won't find.

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
