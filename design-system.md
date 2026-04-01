# Design System Documentation

## Overview

This design system defines the visual language and component library for our SaaS platform. It emphasizes **modernity, clarity, and elegance** while maintaining consistency across all user interfaces. The system is built on a foundation of clean whites, vibrant accent colors, and sophisticated dark text, creating a professional yet approachable aesthetic.

---

## Table of Contents

1. [Design Philosophy](#design-philosophy)
2. [Color System](#color-system)
3. [Typography](#typography)
4. [Spacing & Layout](#spacing--layout)
5. [Shadows & Elevation](#shadows--elevation)
6. [Border Radius](#border-radius)
7. [Components](#components)
   - [Buttons](#buttons)
   - [Cards](#cards)
   - [Badges & Pills](#badges--pills)
   - [Form Elements](#form-elements)
   - [Tables](#tables)
   - [Navigation](#navigation)
   - [Progress Indicators](#progress-indicators)
   - [Avatars](#avatars)
   - [Empty States](#empty-states)
8. [Animations & Transitions](#animations--transitions)
9. [Icons](#icons)
10. [Data Visualization](#data-visualization)
11. [Responsive Design](#responsive-design)

---

## Design Philosophy

### Core Principles

| Principle | Description |
|-----------|-------------|
| **Clarity First** | Every element serves a purpose. Remove visual noise to let content breathe. |
| **Hierarchy Through Contrast** | Use size, weight, and color to guide users' attention naturally. |
| **Consistency Builds Trust** | Reusable components ensure familiarity across the product. |
| **Delight in Details** | Subtle polish—smooth transitions, refined spacing—creates premium feel. |
| **Accessibility Always** | WCAG 2.1 AA compliance is non-negotiable. |

### Visual Identity

The design language combines **minimalist foundations** with **strategic pops of vibrant color**. Think Apple meets Notion: clean surfaces with moments of delightful energy.

- **Whitespace is generous** — content areas never feel cramped
- **Cards provide structure** — grouping related information in elevated surfaces
- **Color is purposeful** — accents highlight actions and status, not decoration
- **Typography is confident** — bold headings, readable body text

---

## Color System

### Primary Palette

The primary color system centers around **violet/purple** as the brand color, with supporting tones for depth and variety.

```
┌─────────────────────────────────────────────────────────────────────┐
│  PRIMARY GRADIENT                                                   │
│  Direction: 135° (top-left to bottom-right)                        │
│  Colors: #8B5CF6 → #EC4899                                         │
│  Usage: Primary CTAs, highlights, active states                     │
└─────────────────────────────────────────────────────────────────────┘
```

| Color Name | Hex Code | RGB | Usage |
|------------|----------|-----|-------|
| Primary 50 | #F5F3FF | 245, 243, 255 | Lightest tint, subtle backgrounds |
| Primary 100 | #EDE9FE | 237, 233, 254 | Light backgrounds, hover states |
| Primary 200 | #DDD6FE | 221, 214, 254 | Borders, dividers |
| Primary 300 | #C4B5FD | 196, 181, 253 | Icons, secondary elements |
| Primary 400 | #A78BFA | 167, 139, 250 | Active states, selected items |
| Primary 500 | #8B5CF6 | 139, 92, 246 | Primary brand color |
| Primary 600 | #7C3AED | 124, 58, 237 | Primary actions, links |
| Primary 700 | #6D28D9 | 109, 40, 217 | Darker accent, pressed states |
| Primary 800 | #5B21B6 | 91, 33, 182 | Headers, emphasis |
| Primary 900 | #4C1D95 | 76, 29, 149 | Darkest shade, text on light |

### Accent Colors

#### Pink (Secondary)

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Pink 50 | #FDF2F8 | Lightest tint |
| Pink 100 | #FCE7F3 | Light backgrounds |
| Pink 400 | #F472B6 | Icons, highlights |
| Pink 500 | #EC4899 | Brand secondary, gradients |
| Pink 600 | #DB2777 | Emphasis, badges |

#### Cyan (Tertiary)

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Cyan 50 | #ECFEFF | Light backgrounds |
| Cyan 400 | #22D3EE | Icons, links |
| Cyan 500 | #06B6D4 | Tertiary accent, info states |
| Cyan 600 | #0891B2 | Active links |

### Semantic Colors

#### Success

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Success Light | #D1FAE5 | Success backgrounds |
| Success Default | #10B981 | Success icons, indicators |
| Success Dark | #059669 | Success text |
| Success 500 | #22C55E | Green checkmarks, positive |

#### Warning

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Warning Light | #FEF3C7 | Warning backgrounds |
| Warning Default | #F59E0B | Warning icons, alerts |
| Warning Dark | #D97706 | Warning text |

#### Error

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Error Light | #FEE2E2 | Error backgrounds |
| Error Default | #EF4444 | Error icons, destructive actions |
| Error Dark | #DC2626 | Error text |

#### Info

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Info Light | #E0F2FE | Info backgrounds |
| Info Default | #0EA5E9 | Info icons, neutral alerts |
| Info Dark | #0284C7 | Info text |

### Neutral Palette

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Gray 0 | #FFFFFF | Card backgrounds, inputs |
| Gray 25 | #FCFCFD | Page background |
| Gray 50 | #F9FAFB | Alternate backgrounds |
| Gray 100 | #F3F4F6 | Borders, dividers |
| Gray 200 | #E5E7EB | Disabled borders |
| Gray 300 | #D1D5DB | Placeholder text |
| Gray 400 | #9CA3AF | Disabled text, hints |
| Gray 500 | #6B7280 | Secondary text |
| Gray 600 | #4B5563 | Body text |
| Gray 700 | #374151 | Headings |
| Gray 800 | #1F2937 | Emphasis |
| Gray 900 | #111827 | Primary text, highest contrast |

### Dark Mode Colors (Future)

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Dark 50 | #1E293B | Card backgrounds |
| Dark 100 | #0F172A | Page background |
| Dark 200 | #020617 | Deepest background |
| Dark Border | #334155 | Borders in dark mode |

---

## Typography

### Font Family

```
Primary: Inter
Fallbacks: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif
```

Inter is chosen for its excellent legibility at all sizes, comprehensive weight range, and optimized rendering on screens.

### Type Scale

| Element | Size | Weight | Line Height | Letter Spacing | Usage |
|---------|------|--------|-------------|----------------|-------|
| Display XL | 48px | 700 | 1.1 | -0.02em | Hero headlines |
| Display L | 40px | 700 | 1.15 | -0.02em | Page titles |
| Display M | 32px | 600 | 1.2 | -0.01em | Section headers |
| Display S | 28px | 600 | 1.25 | -0.01em | Subsection titles |
| Heading XL | 24px | 600 | 1.3 | 0 | Card titles |
| Heading L | 20px | 600 | 1.35 | 0 | Subsection headings |
| Heading M | 18px | 600 | 1.4 | 0 | Component headings |
| Heading S | 16px | 600 | 1.4 | 0.01em | Labels |
| Body L | 16px | 400 | 1.5 | 0 | Primary body text |
| Body M | 14px | 400 | 1.5 | 0.01em | Secondary text |
| Body S | 13px | 400 | 1.5 | 0.01em | Tertiary text |
| Caption | 12px | 500 | 1.4 | 0.02em | Labels, metadata |
| Overline | 11px | 600 | 1.3 | 0.08em | Categories, tags |

### Font Weights

| Name | Value | Usage |
|------|-------|-------|
| Regular | 400 | Body text, descriptions |
| Medium | 500 | Emphasis, labels |
| Semibold | 600 | Headings, buttons |
| Bold | 700 | Display text, emphasis |

### Text Colors

| Name | Hex Code | Usage |
|------|----------|-------|
| Text Primary | #111827 | Headlines, important content |
| Text Secondary | #4B5563 | Body text |
| Text Tertiary | #6B7280 | Descriptions, metadata |
| Text Disabled | #9CA3AF | Disabled states |
| Text Inverse | #FFFFFF | Text on dark/colored backgrounds |

---

## Spacing & Layout

### Spacing Scale

Base unit: **4px**

| Token | Value | Pixels | Usage |
|-------|-------|--------|-------|
| space-0 | 0 | 0 | No spacing |
| space-1 | 0.25 | 4px | Tight gaps, icon padding |
| space-2 | 0.5 | 8px | Component internal spacing |
| space-3 | 0.75 | 12px | Compact spacing |
| space-4 | 1 | 16px | Standard spacing |
| space-5 | 1.25 | 20px | Comfortable spacing |
| space-6 | 1.5 | 24px | Section internal spacing |
| space-8 | 2 | 32px | Card padding |
| space-10 | 2.5 | 40px | Section gaps |
| space-12 | 3 | 48px | Large gaps |
| space-16 | 4 | 64px | Page sections |
| space-20 | 5 | 80px | Major sections |
| space-24 | 6 | 96px | Page margins (large) |

### Layout Grid

#### Container Widths

| Name | Max Width | Padding | Usage |
|------|-----------|---------|-------|
| Container XS | 320px | 16px | Mobile single column |
| Container SM | 640px | 24px | Mobile/Laptop content |
| Container MD | 768px | 32px | Tablet layouts |
| Container LG | 1024px | 40px | Desktop content |
| Container XL | 1280px | 48px | Wide desktop |
| Container 2XL | 1536px | 64px | Maximum width |

#### Grid System

- **Columns**: 12-column grid
- **Gutter**: 24px (desktop), 16px (mobile)
- **Margin**: 24px (desktop), 16px (mobile)

### Page Layout Structure

```
┌──────────────────────────────────────────────────────────────┐
│  HEADER (64px height)                                        │
│  [Logo]              [Search]              [User Menu]       │
├──────────┬───────────────────────────────────────────────────┤
│          │                                                   │
│  SIDEBAR │  MAIN CONTENT AREA                               │
│  (240px) │                                                   │
│          │  ┌─────────────────────────────────────────────┐  │
│  [Nav]   │  │  Page Header                               │  │
│  [Items] │  │  Title + Actions                           │  │
│          │  └─────────────────────────────────────────────┘  │
│          │                                                   │
│          │  ┌──────────┐  ┌──────────┐  ┌──────────┐       │
│          │  │  Card    │  │  Card    │  │  Card    │       │
│          │  │          │  │          │  │          │       │
│          │  └──────────┘  └──────────┘  └──────────┘       │
│          │                                                   │
└──────────┴───────────────────────────────────────────────────┘
```

### Card Layouts

#### Dashboard Grid

- **Columns**: 4 (desktop), 2 (tablet), 1 (mobile)
- **Gap**: 24px
- **Card internal padding**: 24px

#### Content Area

- **Max width**: 1280px
- **Padding**: 32px (desktop), 16px (mobile)

---

## Shadows & Elevation

### Shadow Scale

| Name | Value | Usage |
|------|-------|-------|
| shadow-xs | 0 1px 2px rgba(0, 0, 0, 0.05) | Subtle separation |
| shadow-sm | 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06) | Cards, inputs |
| shadow-md | 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06) | Dropdowns, modals |
| shadow-lg | 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05) | Popovers |
| shadow-xl | 0 20px 25px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.04) | Modals |
| shadow-2xl | 0 25px 50px rgba(0, 0, 0, 0.25) | Full overlays |

### Shadow Usage by Context

| Context | Shadow | Opacity |
|---------|--------|---------|
| Cards (resting) | shadow-sm | 100% |
| Cards (hover) | shadow-md | 100% |
| Dropdowns | shadow-lg | 100% |
| Modals | shadow-xl | 100% |
| Popovers | shadow-lg | 100% |
| Focus rings | shadow-focus | Primary 500 @ 50% |

### Colored Shadows

For premium components, use colored shadows matching the primary brand:

```css
/* Primary glow */
box-shadow: 0 4px 14px rgba(139, 92, 246, 0.25);

/* Gradient glow */
box-shadow: 0 4px 16px rgba(139, 92, 246, 0.2), 0 0 40px rgba(236, 72, 153, 0.1);
```

---

## Border Radius

### Radius Scale

| Token | Value | Usage |
|-------|-------|-------|
| radius-none | 0 | Sharp edges, technical UI |
| radius-sm | 6px | Small elements, chips |
| radius-md | 8px | Inputs, small cards |
| radius-lg | 12px | Cards, buttons |
| radius-xl | 16px | Large cards, panels |
| radius-2xl | 24px | Hero sections |
| radius-full | 9999px | Pills, avatars, badges |

### Radius Usage by Component

| Component | Border Radius |
|-----------|---------------|
| Buttons (small) | radius-md |
| Buttons (large) | radius-lg |
| Inputs | radius-lg |
| Cards | radius-xl |
| Badges | radius-full |
| Avatars | radius-full |
| Modals | radius-2xl |
| Dropdowns | radius-lg |
| Checkboxes | radius-sm |
| Toggle switches | radius-full |

### Border Widths

| Token | Value | Usage |
|-------|-------|-------|
| border-0 | 0 | No border |
| border | 1px | Default borders |
| border-2 | 2px | Emphasis borders |
| border-4 | 4px | Active states |

---

## Components

### Buttons

Buttons are the primary interaction elements. Use the gradient for primary actions.

#### Button Variants

| Variant | Background | Text | Border | Shadow | Usage |
|---------|------------|------|--------|--------|-------|
| Primary | Gradient (primary → pink) | White | None | shadow-sm | Main CTAs |
| Secondary | White | Gray 700 | 1px Gray 200 | None | Secondary actions |
| Tertiary | Transparent | Primary 600 | None | None | Subtle actions |
| Ghost | Transparent | Gray 600 | None | None | Tertiary actions |
| Destructive | Red 500 | White | None | shadow-sm | Delete actions |
| Outline Destructive | Transparent | Red 500 | 1px Red 500 | None | Subtle delete |

#### Button Sizes

| Size | Height | Padding | Font Size | Icon Size | Radius |
|------|--------|---------|-----------|-----------|--------|
| XS | 32px | 8px 12px | 12px | 14px | radius-md |
| SM | 36px | 8px 14px | 13px | 16px | radius-lg |
| MD | 40px | 10px 16px | 14px | 18px | radius-lg |
| LG | 48px | 12px 24px | 16px | 20px | radius-lg |
| XL | 56px | 16px 32px | 18px | 24px | radius-xl |

#### Button States

| State | Visual Change |
|-------|---------------|
| Default | Standard appearance |
| Hover | Slight brightness increase, shadow-md |
| Active/Pressed | Scale 0.98, darker background |
| Focus | Focus ring (primary 500 @ 50%) |
| Disabled | Opacity 50%, cursor not-allowed |
| Loading | Spinner replaces text/icon |

#### Icon Buttons

- Use with Lucide icons
- Always include aria-label
- Maintain square aspect ratio
- Sizes: 32px (SM), 40px (MD), 48px (LG)

#### Button Groups

- Stack horizontally with 8px gap
- Use dividers between grouped actions
- First button: radius-lg (left side)
- Middle buttons: radius-none
- Last button: radius-lg (right side)

---

### Cards

Cards organize content into digestible sections with visual separation.

#### Card Variants

| Variant | Background | Border | Shadow | Radius |
|---------|------------|--------|--------|--------|
| Elevated | White | None | shadow-sm | radius-xl |
| Bordered | White | 1px Gray 200 | None | radius-xl |
| Filled | Gray 50 | None | None | radius-xl |
| Interactive | White | None | shadow-sm → shadow-md (hover) | radius-xl |

#### Card Anatomy

```
┌─────────────────────────────────────────┐
│  HEADER                                 │
│  ┌─────────────────────────────────────┐│
│  │  Title            [Action Menu ⋮]  ││
│  │  Subtitle (optional)                ││
│  └─────────────────────────────────────┘│
├─────────────────────────────────────────┤
│  BODY                                   │
│                                         │
│  Content area with flexible padding     │
│                                         │
│                                         │
├─────────────────────────────────────────┤
│  FOOTER (optional)                      │
│  ┌─────────────────────────────────────┐│
│  │  [Secondary]           [Primary]   ││
│  └─────────────────────────────────────┘│
└─────────────────────────────────────────┘
```

#### Card Sizes

| Size | Padding | Title Size | Radius |
|------|---------|------------|--------|
| Compact | 16px | Body M | radius-lg |
| Default | 24px | Heading M | radius-xl |
| Spacious | 32px | Heading L | radius-2xl |

#### Stat Cards

Specialized cards for displaying key metrics:

```
┌─────────────────────────────────────┐
│  [Icon]                    [Trend] │
│                                     │
│  Metric Value                       │
│  12,345                             │
│                                     │
│  Label                             │
│  Total Revenue                     │
└─────────────────────────────────────┘
```

- Icon: 40x40px container, colored background
- Value: Display M, bold
- Label: Body M, secondary color
- Trend: Success (up) or Error (down) with arrow

---

### Badges & Pills

Status indicators and categorical labels.

#### Badge Variants

| Variant | Background | Text | Border |
|---------|------------|------|--------|
| Default | Gray 100 | Gray 700 | None |
| Primary | Primary 100 | Primary 700 | None |
| Success | Success Light | Success Dark | None |
| Warning | Warning Light | Warning Dark | None |
| Error | Error Light | Error Dark | None |
| Info | Info Light | Info Dark | None |

#### Badge Sizes

| Size | Height | Font | Padding | Radius |
|------|--------|------|---------|--------|
| SM | 20px | Caption | 4px 8px | radius-sm |
| MD | 24px | Body S | 4px 10px | radius-full |
| LG | 28px | Body M | 6px 12px | radius-full |

#### Pill Badges

Fully rounded badges for categories and tags:

- Height: 28px
- Padding: 8px 16px
- Font: Body S, medium
- Background: Light tint of category color
- Text: Category color

#### Status Dots

Inline indicators for real-time status:

| Status | Color | Usage |
|--------|-------|-------|
| Online/Active | Success | Green dot |
| Away/Pending | Warning | Yellow dot |
| Offline/Error | Error | Red dot |
| Neutral | Gray 400 | Gray dot |

Size: 8px circle, positioned with 4px margin

---

### Form Elements

#### Text Input

```
┌─────────────────────────────────────┐
│  Label                              │
│  ┌─────────────────────────────────┐│
│  │ [Icon]  Placeholder text      ││
│  └─────────────────────────────────┘│
│  Helper text or error message       │
└─────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Height | 44px |
| Padding | 12px 16px |
| Border | 1px Gray 300 |
| Radius | radius-lg |
| Focus border | Primary 500 |
| Focus ring | Primary @ 20%, 2px |

#### Input States

| State | Border Color | Shadow |
|-------|-------------|--------|
| Default | Gray 300 | None |
| Hover | Gray 400 | None |
| Focus | Primary 500 | shadow-focus |
| Error | Red 500 | shadow-error |
| Disabled | Gray 200 | None |

#### Textarea

- Min height: 100px
- Resize: vertical only
- Character count: Bottom right, muted text

#### Select/Dropdown

| Property | Value |
|----------|-------|
| Height | 44px |
| Chevron icon | 20px, Gray 400 |
| Dropdown shadow | shadow-lg |
| Option hover | Gray 100 |

#### Checkbox

| Property | Value |
|----------|-------|
| Size | 20px |
| Border radius | radius-sm |
| Checked background | Primary 500 |
| Check color | White |
| Focus ring | Primary @ 30% |

#### Toggle Switch

| Property | Value |
|----------|-------|
| Width | 44px |
| Height | 24px |
| Knob diameter | 20px |
| Off background | Gray 300 |
| On background | Primary 500 |
| Transition | 200ms ease |

#### Radio Button

| Property | Value |
|----------|-------|
| Size | 20px |
| Border radius | radius-full |
| Selected indicator | 10px circle, Primary 500 |
| Focus ring | Primary @ 30% |

#### Form Layout

- Vertical gap: 20px between fields
- Labels: Body M, Medium weight, Gray 700
- Helper text: Body S, Gray 500
- Error text: Body S, Red 500
- Required indicator: Red asterisk

---

### Tables

Data tables for structured information.

#### Table Anatomy

```
┌────────────────────────────────────────────────────────────────┐
│  TABLE HEADER                                                  │
│  ┌──────────┬──────────┬──────────┬─────────────────────────┐ │
│  │ Header 1 │ Header 2 │ Header 3 │ Header 4                │ │
│  └──────────┴──────────┴──────────┴─────────────────────────┘ │
├────────────────────────────────────────────────────────────────┤
│  TABLE BODY                                                    │
│  ┌──────────┬──────────┬──────────┬─────────────────────────┐ │
│  │ Cell 1   │ Cell 2   │ Cell 3   │ Cell 4                  │ │
│  ├──────────┼──────────┼──────────┼─────────────────────────┤ │
│  │ Cell 5   │ Cell 6   │ Cell 7   │ Cell 8                  │ │
│  └──────────┴──────────┴──────────┴─────────────────────────┘ │
├────────────────────────────────────────────────────────────────┤
│  TABLE FOOTER (optional)                                       │
│  Showing 1-10 of 100 results                    [<] [1] [2] [>]│
└────────────────────────────────────────────────────────────────┘
```

#### Table Styles

| Element | Style |
|---------|-------|
| Header background | Gray 50 |
| Header text | Body S, Medium, Gray 600 |
| Header border | 1px Gray 200 (bottom) |
| Row background | White |
| Row hover | Gray 50 |
| Cell padding | 16px |
| Cell text | Body M, Gray 800 |
| Border | 1px Gray 100 (horizontal) |
| Zebra striping | Optional, Gray 25 |

#### Table Features

- Sortable columns: Click header, show arrow indicator
- Selectable rows: Checkbox column
- Expandable rows: Chevron icon
- Inline actions: Icon buttons on hover

---

### Navigation

#### Sidebar Navigation

```
┌────────────────────────────────┐
│  [Logo]                        │
├────────────────────────────────┤
│  ┌──────────────────────────┐ │
│  │ 📊 Dashboard             │ │  ← Active
│  └──────────────────────────┘ │
│  ┌──────────────────────────┐ │
│  │ 📦 Products             │ │
│  └──────────────────────────┘ │
│  ┌──────────────────────────┐ │
│  │ 🛒 Orders               │ │
│  └──────────────────────────┘ │
│  ...                          │
├────────────────────────────────┤
│  ┌──────────────────────────┐ │
│  │ ⚙️ Settings             │ │
│  └──────────────────────────┘ │
└────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Width | 240px (expanded), 72px (collapsed) |
| Background | White |
| Border | 1px Gray 100 (right) |
| Item height | 44px |
| Item padding | 12px 16px |
| Item radius | radius-lg |
| Active item | Primary 50 background, Primary 600 text |
| Hover item | Gray 100 background |
| Icon size | 20px |

#### Top Header

```
┌─────────────────────────────────────────────────────────────────────┐
│  [☰ Menu]  [Logo]          [🔍 Search]        [🔔] [User Avatar ▼] │
└─────────────────────────────────────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Height | 64px |
| Background | White |
| Border | 1px Gray 100 (bottom) |
| Logo height | 32px |
| Search width | 320px |
| User avatar | 40px |

#### Breadcrumbs

- Separator: Chevron right icon
- Current page: Bold, not clickable
- Parent pages: Gray 600, clickable
- Hover: Underline

#### Tabs

| Property | Value |
|----------|-------|
| Height | 40px |
| Gap between tabs | 4px |
| Active indicator | 2px bottom border, Primary 500 |
| Active text | Primary 600, Medium |
| Inactive text | Gray 500 |
| Hover text | Gray 700 |

---

### Progress Indicators

#### Progress Bar

| Property | Value |
|----------|-------|
| Height | 8px |
| Background | Gray 200 |
| Fill | Gradient (Primary → Pink) |
| Radius | radius-full |
| Animation | 300ms ease-out |

#### Circular Progress

| Property | Value |
|----------|-------|
| Sizes | 40px, 64px, 96px, 128px |
| Stroke width | 4px (small), 6px (medium), 8px (large) |
| Background | Gray 200 |
| Fill | Gradient (Primary → Pink) |

#### Skeleton Loaders

Shimmering placeholders during content loading:

| Property | Value |
|----------|-------|
| Background | Gray 200 |
| Shimmer | Linear gradient animation |
| Shimmer color | White @ 40% |
| Duration | 1.5s infinite |

#### Spinner

| Property | Value |
|----------|-------|
| Sizes | 16px (inline), 24px (button), 40px (page) |
| Stroke width | 2px |
| Color | Primary 500 |
| Animation | Rotate 360°, 0.75s linear infinite |

---

### Avatars

User representation with multiple fallback options.

#### Avatar Sizes

| Size | Diameter | Font | Container |
|------|----------|------|-----------|
| XS | 24px | Caption | radius-full |
| SM | 32px | Body S | radius-full |
| MD | 40px | Body M | radius-full |
| LG | 48px | Heading S | radius-full |
| XL | 64px | Heading M | radius-full |
| 2XL | 96px | Heading L | radius-full |

#### Avatar Variants

| Variant | Content | Background |
|---------|---------|------------|
| Image | Profile photo | None |
| Initials | First + Last name | Primary 500 (white text) |
| Icon | Lucide user icon | Gray 200 (gray icon) |

#### Avatar Groups

- Stack with -8px overlap
- Maximum 5 visible + "+N" overflow avatar
- Ring: 2px white border

---

### Empty States

Placeholder UI when no content exists.

#### Empty State Anatomy

```
┌─────────────────────────────────────────┐
│                                         │
│            [Illustration]               │
│                                         │
│         No items yet                    │
│                                         │
│    Description of why this is empty    │
│    and what to do about it              │
│                                         │
│           [+ Create First Item]        │
│                                         │
└─────────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Illustration | 200x200px max |
| Title | Heading M, Gray 800, centered |
| Description | Body M, Gray 500, centered, max 400px |
| CTA | Primary button, centered |

#### Empty State Variations

- **No data**: Generic illustration, "No [items] yet"
- **No results**: Search illustration, "No matches found"
- **Error**: Error illustration, retry action
- **Maintenance**: Warning illustration, expected time

---

## Animations & Transitions

### Timing Functions

| Name | Value | Usage |
|------|-------|-------|
| ease-in | cubic-bezier(0.4, 0, 1, 1) | Elements entering |
| ease-out | cubic-bezier(0, 0, 0.2, 1) | Elements exiting |
| ease-in-out | cubic-bezier(0.4, 0, 0.2, 1) | Expanding/collapsing |
| spring | cubic-bezier(0.68, -0.55, 0.265, 1.55) | Bouncy interactions |

### Duration Scale

| Token | Duration | Usage |
|-------|----------|-------|
| instant | 0ms | Immediate feedback |
| fast | 100ms | Micro-interactions, hover |
| normal | 200ms | Default transitions |
| slow | 300ms | Modals, drawers |
| slower | 500ms | Page transitions |

### Common Animations

| Animation | Property | Duration | Easing |
|-----------|----------|----------|--------|
| Fade in | opacity 0→1 | 200ms | ease-out |
| Slide up | transform Y 8px→0 | 200ms | ease-out |
| Scale | transform scale 0.95→1 | 200ms | ease-out |
| Collapse | height 0 | 300ms | ease-in-out |
| Rotate | transform rotate | 500ms | linear (loaders) |

### Hover Animations

| Element | Animation |
|---------|-----------|
| Buttons | Scale 0.98, shadow increase |
| Cards | Shadow elevation, slight lift (translateY -2px) |
| Links | Color transition, underline (optional) |
| Icons | Color change |
| Nav items | Background fade |

### Page Transitions

- Fade between routes: 200ms
- Staggered list items: 50ms delay between each

---

## Icons

### Icon Library

**Lucide React** (primary) or **Heroicons** (fallback)

### Icon Sizes

| Token | Size | Usage |
|-------|------|-------|
| icon-xs | 14px | Inline with caption text |
| icon-sm | 16px | Inline with body text |
| icon-md | 18px | Buttons, nav items |
| icon-lg | 20px | Cards, headers |
| icon-xl | 24px | Feature sections |
| icon-2xl | 32px | Empty states, heroes |
| icon-3xl | 48px | Error/success pages |

### Icon Colors

| Context | Color |
|---------|-------|
| Default | Gray 500 |
| Hover | Gray 700 |
| Active | Primary 600 |
| Disabled | Gray 400 |
| Inverse (on dark) | White |

### Icon Button

- Always include `aria-label`
- Square aspect ratio
- Hover: Gray 100 background
- Focus: Ring outline

---

## Data Visualization

### Charts

#### Line Chart

| Property | Value |
|----------|-------|
| Line stroke | 2px, Primary 500 |
| Fill | Gradient Primary → Transparent |
| Grid lines | Gray 100, dashed |
| Axis labels | Body S, Gray 500 |
| Tooltip | White card, shadow-lg |

#### Bar Chart

| Property | Value |
|----------|-------|
| Bar radius | radius-md (top corners) |
| Bar gap | 8px |
| Bar colors | Gradient or categorical palette |
| Hover | Opacity 0.9, show tooltip |

#### Donut Chart

| Property | Value |
|----------|-------|
| Stroke width | 16px |
| Gap between segments | 2px |
| Center text | Metric value |
| Legend | Below chart, horizontal |

### Color Palette for Charts

| Series | Color |
|--------|-------|
| Series 1 | Primary 500 |
| Series 2 | Cyan 500 |
| Series 3 | Pink 500 |
| Series 4 | Success 500 |
| Series 5 | Warning 500 |

### Stat Display

```
┌─────────────────────────────────────────┐
│                                         │
│        ↑ 12.5%                          │  ← Trend badge
│                                         │
│        $45,231.89                       │  ← Large value
│                                         │
│        Total Revenue                    │  ← Label
│        This month                       │  ← Subtext
│                                         │
└─────────────────────────────────────────┘
```

---

## Responsive Design

### Breakpoints

| Breakpoint | Width | Columns | Sidebar |
|------------|-------|---------|---------|
| Mobile | < 640px | 1 | Hidden (drawer) |
| Tablet | 640-1024px | 2-4 | Collapsed (icons) |
| Desktop | 1024-1280px | 6-8 | Expanded |
| Wide | > 1280px | 12 | Expanded |

### Mobile Considerations

- Full-width cards
- Bottom navigation bar
- Swipe gestures for actions
- Touch targets: minimum 44x44px
- Simplified tables (card view)

### Tablet Considerations

- 2-column grid for cards
- Collapsible sidebar
- Horizontal scroll for tables
- Larger touch targets

### Desktop Considerations

- Full sidebar navigation
- 4-column grid for cards
- Fixed headers
- Keyboard shortcuts visible

---

## Accessibility

### Color Contrast

| Text Type | Minimum Ratio | Our Value |
|-----------|---------------|-----------|
| Body text | 4.5:1 | 10.5:1 (Gray 600 on White) |
| Large text | 3:1 | 7.5:1 (Gray 500 on White) |
| UI elements | 3:1 | 4.8:1 (Primary 500 on White) |

### Focus States

All interactive elements must have visible focus:

```css
/* Focus ring style */
box-shadow: 0 0 0 2px white, 0 0 0 4px Primary 500;
outline: none;
```

### Screen Reader Support

- Semantic HTML elements
- ARIA labels on icons
- Alt text for images
- Live regions for dynamic content
- Skip navigation links

### Reduced Motion

```css
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}
```

---

## Implementation Guidelines

### CSS Variables

All design tokens should be implemented as CSS custom properties:

```css
:root {
  /* Colors */
  --color-primary-500: #8B5CF6;
  --color-primary-600: #7C3AED;
  --color-gray-700: #374151;
  
  /* Typography */
  --font-family: "Inter", system-ui, sans-serif;
  --font-size-body: 14px;
  --font-weight-medium: 500;
  
  /* Spacing */
  --space-4: 16px;
  --space-6: 24px;
  
  /* Shadows */
  --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
  --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
  
  /* Radius */
  --radius-lg: 12px;
  --radius-xl: 16px;
}
```

### Component Architecture

```
/components
  /Button
    Button.tsx
    Button.css
    Button.stories.tsx
  /Card
    Card.tsx
    Card.css
    Card.stories.tsx
  ...
```

### Testing Checklist

- [ ] Visual regression tests
- [ ] Accessibility audits (axe-core)
- [ ] Cross-browser testing
- [ ] Mobile responsive testing
- [ ] Dark mode (if implemented)
- [ ] Reduced motion preference

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2026-03-18 | Initial design system |

---

*This design system is a living document. Update as the product evolves and new patterns emerge.*
