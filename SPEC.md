# michaelrill.xyz WordPress Theme: Rebuild Specification

## 1. Intent

Build a classic WordPress PHP theme for a personal blog with these goals:

**Landing page.** The site's front door should be a bento/mosaic grid — an editorial layout that gives an impression of the site and directs visitors to key content. Not a blog feed. Hardcoded tiles linking to featured posts, an about page, an archive, and the blog feed. The grid should feel irregular (not a uniform card grid) — tiles of different sizes, some spanning multiple rows or columns. The layout should include a hero tile, a pull quote, navigation tiles, article tiles, and an identity/colophon tile. A single `front-page.php` template controls this; WordPress's template hierarchy makes it override the homepage automatically.

**Archive page.** A dynamic, plugin-free archive listing every published post grouped by year, newest first. Three-column layout: year label (shown only on the first post of each year group) | post title | date. Category filter pills above the list — clicking a pill filters the archive client-side to show only posts in that category. The subtitle beneath the heading should update to show the selected category's description (pulled from WordPress's category description field, with a post-count fallback).

**Uniform post rendering.** All post formats (standard, aside, etc.) render identically in the feed — title, date, reading time in a left metadata column, content in the right column. No separate template or visual treatment for asides.

**Admin convenience.** When a logged-in user with edit permissions views any post (feed or single), a small "Edit" link appears in the metadata column linking to the WordPress admin editor.

**Typography.** Body text at 1.15rem using a variable-weight sans-serif (Manrope). Headings scaled proportionally. Bold text must be clearly distinguishable from the light (300-weight) body text.

**Dark mode.** Full dark mode via CSS custom properties, toggled by a `[data-theme="dark"]` attribute.

---

## 2. Discovered Choices

These are decisions we arrived at through iteration. Each one cost significant debugging time when done wrong.

### Hosting CDN caches static CSS — use inline styles or PHP-generated CSS as escape hatch

The hosting provider serves `style.css` from a CDN cache that ignores WordPress's `?ver=` query-string cache busting. After deploying CSS changes, the old stylesheet continues to be served for an unpredictable duration. **Two workarounds exist:**

1. For template-specific styles (like the archive page), embed a `<style>` block directly in the PHP template. PHP files are always executed server-side and never CDN-cached.
2. For global overrides that must take effect immediately, use `wp_add_inline_style()` in `functions.php` to inject CSS into the `<head>`. This is PHP-generated and bypasses the CDN. Remove these overrides once the CDN cache clears and the real `style.css` is being served (verify by checking the version number in DevTools).

Bump the `Version:` header in `style.css` with every CSS change so the cache *eventually* invalidates.

### Never use `transition: all` on anchor elements

Chromium browsers (Edge, Chrome) have a privacy-related restriction on `:visited` link styling. When an `<a>` element has `transition: all`, Chromium tries to animate the internal `:visited` color change and enters a broken state where `:hover` stops triggering after the user visits a link. **The fix:** always use explicit property lists in transitions on links (e.g., `transition: color 0.2s, background 0.2s`). This is invisible in Safari (which handles `:visited` more leniently) but breaks hover entirely in Chromium.

### Every link selector that sets `color` needs a matching `:visited` rule

Without explicit `:visited` rules, Chromium applies its default visited-link color (a grey), overriding theme colors. This must be done for *every* link selector in the stylesheet — base `a`, `.entry-content a`, `.entry-title a`, `.main-navigation a`, footer links, etc. Each `:visited` rule should match the unvisited state exactly. Omitting even one selector creates inconsistent link colors after the user clicks around the site.

### File deletions don't propagate reliably — change the dispatch instead

Deleting a template file (e.g., `content-aside.php`) from git doesn't guarantee it disappears from the server. Many deployment pipelines add/update files but don't remove deleted ones. **The robust fix:** instead of relying on the file's absence for WordPress's template fallback, change the calling code to stop dispatching by post format entirely (`get_template_part('template-parts/content')` instead of `get_template_part('template-parts/content', get_post_format())`).

### Light body weight (300) requires explicit bold styling

With Manrope at `font-weight: 300`, the browser's default bold (700) is technically applied to `<strong>`/`<b>` elements but is not visually distinct enough. An explicit rule is needed: `font-weight: 700` (or 600) plus `color: var(--color-heading)` to add a color contrast signal alongside the weight change. The dual signal (heavier + darker) makes bold unmistakable.

### Archive filter pills must recalculate year labels after filtering

The archive groups posts by year with the year label shown only on the first post of each group. When filtering by category, the first post of a year group may be hidden, causing the year label to disappear. **Solution:** store the year as a `data-year` attribute on every row, render all year label `<span>` elements empty initially, and use JavaScript to recalculate which visible rows should display the year label after every filter change.

### Category descriptions contain HTML entities

WordPress's `category_description()` returns HTML with encoded entities (`&#8220;` for curly quotes, etc.). `wp_strip_all_tags()` strips markup but leaves entities as raw text. Wrap the result in `html_entity_decode($desc, ENT_QUOTES, 'UTF-8')` before passing it to the frontend.

### Inline edit links inherit base anchor styling

A link (`<a>`) styled with a class will still inherit the base `a` rule's `text-decoration`, `text-underline-offset`, and `text-decoration-thickness` unless explicitly overridden. Use `a.classname` (element + class) for higher specificity, and explicitly zero out `text-decoration-thickness`, `border`, and `box-shadow`.

---

## 3. Validation Strategy

### Visual consistency across browsers

The theme must look and behave identically in Safari and Chromium-based browsers (Edge, Chrome). The critical test: visit several links on the site, navigate back, and verify that (a) link colors have not changed to grey/purple, and (b) hover effects still trigger on every link. Test both light and dark modes.

### Filter correctness

On the archive page: selecting a category pill must show only posts in that category, hide all others, display the correct year label on the first visible post per year, and update the subtitle to the category's description. Selecting "All" must restore the full list with original year labels and subtitle. Posts belonging to multiple categories must appear under any matching filter.

### Logged-in vs. logged-out divergence

The "Edit" link must appear for logged-in users with edit capability and must be completely absent (not hidden — not rendered) for logged-out visitors. Verify by viewing page source in an incognito window.

### Responsive behavior

- The bento grid must degrade from a 5-column layout to 2 columns (tablet) to single column (mobile) without breaking.
- Archive filter pills must wrap naturally on narrow screens at a reduced font size without requiring horizontal scrolling.
- The two-column post layout (metadata | content) must collapse to stacked on mobile.

### Typography hierarchy

At any viewport width: body text (1.15rem) < post titles (xlarge) < page headings (xxlarge). Bold text within body copy must be visually distinguishable at a glance — test with a paragraph where one sentence is bold and the rest is not.

### Cache resilience

CSS changes in `style.css` may not take effect immediately due to CDN caching. Any style that must take effect on deploy should either be inline in a PHP template or injected via `wp_add_inline_style()`. No feature should silently break because the CDN is serving a stale stylesheet.

### Template uniformity

All post formats must render through the same template with the same visual treatment. Verify by creating an "aside" format post and confirming it displays a title, date, and reading time in the left column — identical to standard posts.
