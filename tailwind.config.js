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
          25: '#F7F6F1',
          50: '#EFEDE4',
          100: '#E4E0D2',
          200: '#CFC8B6',
          300: '#B5AD98',
          400: '#8C846F',
          500: '#6D6758',
          600: '#4E4A41',
          700: '#36342D',
          800: '#24241F',
          900: '#151814',
        },
        primary: {
          50: '#EEF4FF',
          100: '#DCE7FF',
          200: '#BFD3FF',
          300: '#97B6FF',
          400: '#6992FF',
          500: '#3F72FF',
          600: '#2957EF',
          700: '#2144CA',
          800: '#223AA3',
          900: '#1F327F',
        },
        pink: {
          50: '#FFF0FA',
          100: '#FFD9EF',
          400: '#FF68B7',
          500: '#F044A2',
          600: '#D53086',
        },
        cyan: {
          50: '#F1F4FF',
          100: '#E1E7FF',
          400: '#8E93FF',
          500: '#6D73FF',
          600: '#555CE7',
        },
        success: {
          50: '#EEF2FF',
          500: '#6D73FF',
          600: '#555CE7',
          700: '#3F46C8',
        },
        warning: {
          50: '#FFF6DB',
          500: '#F3B33D',
          600: '#D8901E',
        },
        error: {
          50: '#FFF0EC',
          500: '#EF6B5A',
          600: '#D65143',
        },
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
        display: ['Fraunces', 'serif'],
      },
    },
  },
  plugins: [],
};
