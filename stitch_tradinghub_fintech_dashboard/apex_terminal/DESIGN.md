# Design System Specification: The Kinetic Obsidian

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Precision Terminal."** 

Unlike generic fintech interfaces that rely on flat cards and heavy borders, this system treats the UI as a high-performance instrument—a digital cockpit carved out of dark obsidian and layered with sheets of smart glass. We break the "template" look by prioritizing **Tonal Depth** over structural lines. By utilizing intentional asymmetry and overlapping glass surfaces, we create a sense of focused energy and authoritative precision. The goal is to make the trader feel they are not just looking at data, but looking *through* it.

## 2. Colors
Our palette is rooted in deep slates to minimize eye fatigue during long sessions, with high-chroma accents to signal market movement and primary actions.

*   **Foundation:** The base is `surface` (`#0b1326`). We avoid pure black to maintain a sense of premium "air" and depth.
*   **The "No-Line" Rule:** We do not use 1px solid borders to section off content. Boundaries must be defined through background color shifts. For example, a sidebar should be `surface_container_low`, while the main workspace is `surface`. The eye should perceive the change in depth, not a "stroke."
*   **Surface Hierarchy & Nesting:** Use the surface-container tiers to create an architectural stack:
    *   `surface_container_lowest`: Background of the primary workspace.
    *   `surface_container_low`: Primary navigation or secondary panels.
    *   `surface_container`: Standard card backgrounds.
    *   `surface_container_high`: Hover states or elevated active panels.
*   **The "Glass & Gradient" Rule:** To achieve the proprietary terminal feel, floating panels (modals, dropdowns, or "quick-trade" widgets) must use a semi-transparent `surface_container_highest` with a `backdrop-blur` of 20px–40px. 
*   **Signature Textures:** For primary CTAs and critical data visualizations, use subtle linear gradients transitioning from `primary` (`#c3c0ff`) to `primary_container` (`#4f46e5`) at a 135-degree angle. This adds a "soul" to the UI that flat colors cannot replicate.

## 3. Typography
We utilize **Inter** across the entire system. Its mathematical precision and high x-height make it the only choice for a data-dense trading environment.

*   **Display & Headline:** Use `display-md` and `headline-lg` sparingly—exclusively for P&L totals or high-level account equity. These should feel like "hero" numbers.
*   **Titles:** `title-md` and `title-sm` are your structural anchors. They define the intent of each glass panel.
*   **Body & Labels:** In a trading environment, the `label-sm` (`0.6875rem`) is your best friend. Use it for metadata like timestamps, order IDs, and ticker details. Pair it with `on_surface_variant` (`#c7c4d8`) to ensure it stays secondary to the primary price data.
*   **Hierarchy via Weight:** Contrast is key. Pair a `title-md` in Bold with a `label-md` in Medium to create a clear "What vs. How" relationship in data tables.

## 4. Elevation & Depth
In this design system, elevation is an optical illusion created by light and transparency, not by physical shadows.

*   **The Layering Principle:** Stacking determines importance. A "Buy" panel should be `surface_container_high` sitting on a `surface_container` background. This "soft lift" feels more modern and less cluttered than traditional drop shadows.
*   **Ambient Shadows:** When a floating element (like a context menu) requires a shadow, use a "Tinted Ambient" approach. The shadow color should be a 40% opacity version of the background (`#0b1326`), with a blur radius of 32px and a 12px vertical offset. It should feel like the element is casting a shadow on a dark floor.
*   **The "Ghost Border" Fallback:** If a layout feels too "bleary" and needs more definition (especially in data-heavy tables), use the `outline_variant` token at 15% opacity. This "Ghost Border" provides a hint of structure without interrupting the flow of the eye.
*   **Glassmorphism:** Apply a 0.5px "inner glow" to the top edge of glass cards using `on_surface` at 10% opacity. This mimics how light catches the edge of a real glass pane.

## 5. Components

### High-Contrast Data Tables
*   **Forbidden:** Horizontal or vertical divider lines.
*   **Guideline:** Separate rows using vertical white space and a subtle background shift (`surface_container_low`) on hover. 
*   **Profit/Loss:** Use `secondary` (`#4edea3`) for positive numbers and `tertiary` (`#ffb2b7`) for negative numbers. Do not use icons alone; the color must be authoritative.

### Buttons
*   **Primary:** A gradient fill (Primary to Primary Container). Roundedness: `md` (`0.375rem`).
*   **Secondary:** Ghost style. No fill, with a `primary` ghost border (15% opacity).
*   **Tertiary:** Text only using `on_primary_fixed_variant` for subtle utility actions.

### Sleek Form Inputs
*   **Background:** `surface_container_lowest`.
*   **Focus State:** A 2px outer ring of `primary_container` with a soft 4px blur. The label should shift to `primary` to indicate the field is "active."
*   **Input Text:** Must use `body-md` for maximum legibility.

### Vibrant Pill Badges
*   Used for strategy tags (e.g., "Scalping," "Long Term").
*   **Style:** Use `primary_container` background with `on_primary_container` text. These should be fully rounded (`rounded-full`).

### List Items
*   Avoid dividers. Use a 12px gap between items. 
*   Leading elements (icons/tickers) should be housed in a `surface_container_highest` circle to provide a "hub" for the eye to rest on.

## 6. Do's and Don'ts

### Do:
*   **Use Asymmetry:** Place high-priority data (like a chart) slightly off-center to create a dynamic "scanning" path for the user.
*   **Embrace Negative Space:** Just because it's a trading terminal doesn't mean it needs to be cramped. Let the data breathe.
*   **Use Tonal Transitions:** Transition from `surface_container_low` to `surface_container` to indicate a shift in information density.

### Don't:
*   **Don't use 100% white:** Use `on_surface` (`#dae2fd`) for primary text. Pure white is too harsh against the slate background and causes "vibration."
*   **Don't use sharp corners:** This is a modern, high-end system. Stick to the `md` (`0.375rem`) and `lg` (`0.5rem`) roundedness scale to keep the interface feeling approachable yet professional.
*   **Don't use standard shadows:** If it looks like a default CSS box-shadow, delete it. Refer to the Ambient Shadow rules in Section 4.