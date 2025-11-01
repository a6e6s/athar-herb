# Dark Mode Implementation Guide

## Overview
The Athar Herb application includes a fully functional dark mode toggle that persists across page loads using localStorage.

## Features

### ✅ Dark Mode Toggle
- **Location**: Top navigation bar (next to search button)
- **Icon**: Moon icon (light mode) / Sun icon (dark mode)
- **Shortcut**: Click the button to toggle between light and dark modes
- **Persistence**: User preference is saved in browser localStorage

### ✅ Supported Components

All UI components have been styled for dark mode compatibility:

#### Navigation
- Navbar background and text colors
- Active link highlighting
- Dropdown menus
- Navbar brand and logo

#### Content Cards
- Product cards
- Blog cards
- Category cards
- Testimonial cards
- FAQ accordions

#### Forms & Inputs
- Form controls (input, textarea, select)
- Form labels and placeholders
- Focus states with proper contrast
- Input groups and text addons

#### Interactive Elements
- Buttons (primary, secondary, success, danger, etc.)
- Links with hover states
- Badges and labels
- Pagination controls

#### Layouts
- Main background
- Section backgrounds
- Footer
- Modals and dialogs
- Toast notifications

#### Tables & Lists
- Table striping
- Hover states
- List groups
- Active states

#### Feedback Components
- Alerts (success, danger, warning, info)
- Toast notifications
- Spinners and loaders

### ✅ Color Scheme

#### Light Mode
- Background: `#fcfcf9` (Cream)
- Surface: `#fffffe` (White)
- Text: `#13343b` (Dark Slate)
- Text Secondary: `#626c71` (Medium Slate)
- Primary: `#21808d` (Teal)
- Accent: `#4ade80` (Green)

#### Dark Mode
- Background: `#1a1a1a` (Dark Gray)
- Surface: `#2d2d2d` (Medium Dark)
- Text: `#e5e5e5` (Light Gray)
- Text Secondary: `#b0b0b0` (Medium Gray)
- Primary: `#4ade80` (Bright Green)
- Border: `rgba(229, 229, 229, 0.15)` (Translucent)

## Implementation Details

### JavaScript (`public/js/app.js`)

```javascript
// Setup Dark Mode
function setupDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (!darkModeToggle) return;

    // Check for saved dark mode preference
    const savedDarkMode = localStorage.getItem('darkMode') === 'true';
    if (savedDarkMode) {
        document.body.classList.add('dark-mode');
        darkMode = true;
        updateDarkModeIcon();
    }

    darkModeToggle.addEventListener('click', function() {
        darkMode = !darkMode;
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', darkMode);
        updateDarkModeIcon();
    });
}

function updateDarkModeIcon() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (!darkModeToggle) return;

    const icon = darkModeToggle.querySelector('i');
    if (icon) {
        icon.className = darkMode ? 'fas fa-sun' : 'fas fa-moon';
    }
}
```

### CSS (`public/css/style.css`)

Dark mode styles are applied using the `.dark-mode` class on the `<body>` element:

```css
body.dark-mode {
    --bg-color: #1a1a1a;
    --surface-color: #2d2d2d;
    --text-color: #e5e5e5;
    --text-secondary: #b0b0b0;
    --border-color: rgba(229, 229, 229, 0.15);
}

body.dark-mode .navbar {
    background-color: var(--surface-color) !important;
    border-bottom: 1px solid var(--border-color);
}

body.dark-mode .card {
    background-color: var(--surface-color);
    border-color: var(--border-color);
    color: var(--text-color);
}

/* ... and many more component-specific styles */
```

### HTML (Navbar Toggle Button)

Located in `resources/views/components/navbar.blade.php`:

```html
<!-- Dark Mode Toggle -->
<button class="btn btn-outline-secondary" id="darkModeToggle" title="وضع داكن/فاتح">
    <i class="fas fa-moon"></i>
</button>
```

## Smooth Transitions

All components include smooth transitions for a polished user experience:

```css
.card, .btn, .form-control, .form-select, .modal-content, .dropdown-menu, .alert {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

body {
    transition: background-color 0.3s ease, color 0.3s ease;
}
```

## Browser Compatibility

Dark mode works in all modern browsers:
- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Opera 76+

## Testing Dark Mode

### Manual Testing
1. Open the application in a browser
2. Click the moon/sun icon in the navigation bar
3. Verify all components switch to dark mode
4. Refresh the page - dark mode should persist
5. Navigate to different pages - preference should remain
6. Clear localStorage and verify it defaults to light mode

### Testing Different Components
1. **Homepage**: Check banners, product cards, testimonials
2. **Products Page**: Verify product grid, filters, pagination
3. **Product Details**: Check image gallery, description, reviews
4. **Blog**: Verify blog cards, post content, comments
5. **Forms**: Test contact form, search, login forms
6. **Modals**: Check search modal, confirmation dialogs
7. **Dropdowns**: Verify user menu, filter dropdowns

## Accessibility

Dark mode includes proper accessibility features:

- ✅ **Contrast Ratios**: All text meets WCAG AA standards (4.5:1 for normal text, 3:1 for large text)
- ✅ **Focus States**: Visible focus indicators in both modes
- ✅ **Color Independence**: Information not conveyed by color alone
- ✅ **Icon Labels**: Toggle button has descriptive title attribute

## Troubleshooting

### Dark Mode Not Persisting
**Issue**: Dark mode resets after page refresh
**Solution**: Check if localStorage is enabled in browser settings

### Some Components Not Styled
**Issue**: Certain elements don't change color in dark mode
**Solution**: Ensure the CSS file is properly loaded and cached is cleared

### Toggle Button Not Working
**Issue**: Clicking the button does nothing
**Solution**: Check browser console for JavaScript errors, ensure app.js is loaded

### Transition Flicker on Load
**Issue**: Page flickers between modes on initial load
**Solution**: This is expected as preference is loaded from localStorage after DOM loads

## Future Enhancements

Potential improvements for dark mode:

- [ ] System preference detection (`prefers-color-scheme`)
- [ ] Auto-switch based on time of day
- [ ] Multiple theme options (not just light/dark)
- [ ] Theme customization (user-selectable accent colors)
- [ ] High contrast mode for better accessibility

## Related Files

- JavaScript: `public/js/app.js` (lines 308-367)
- CSS: `public/css/style.css` (lines 778-1020+)
- Navbar: `resources/views/components/navbar.blade.php` (line 48-51)
- Layout: `resources/views/layouts/app.blade.php` (includes CSS transitions)

## Support

For issues or questions about dark mode:
1. Check browser console for JavaScript errors
2. Verify CSS file is loading correctly
3. Clear browser cache and reload
4. Test in incognito/private browsing mode
5. Check localStorage in browser DevTools

---

**Last Updated**: November 2, 2025
**Version**: 1.0.0
