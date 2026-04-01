export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.vue',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        gray: {
          25: '#FCFCFD',
          50: '#F9FAFB',
          100: '#F3F4F6',
          200: '#E5E7EB',
          300: '#D1D5DB',
          400: '#9CA3AF',
          500: '#6B7280',
          600: '#4B5563',
          700: '#374151',
          800: '#1F2937',
          900: '#111827',
        },
        primary: {
          50: '#F5F3FF',
          100: '#EDE9FE',
          200: '#DDD6FE',
          300: '#C4B5FD',
          400: '#A78BFA',
          500: '#8B5CF6',
          600: '#7C3AED',
          700: '#6D28D9',
          800: '#5B21B6',
          900: '#4C1D95',
        },
        pink: {
          50: '#FDF2F8',
          100: '#FCE7F3',
          400: '#F472B6',
          500: '#EC4899',
          600: '#DB2777',
        },
        cyan: {
          50: '#ECFEFF',
          100: '#E0F2FE',
          400: '#22D3EE',
          500: '#06B6D4',
          600: '#0891B2',
        },
        success: {
          50: '#D1FAE5',
          500: '#22C55E',
          600: '#10B981',
          700: '#059669',
        },
        warning: {
          50: '#FEF3C7',
          500: '#F59E0B',
          600: '#D97706',
        },
        error: {
          50: '#FEE2E2',
          500: '#EF4444',
          600: '#DC2626',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
