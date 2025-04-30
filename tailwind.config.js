module.exports = {
    content: [
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
      './resources/js/**/*.js',
      './resources/js/**/*.vue',
      './app/Http/Livewire/**/*.php',
    ],
    theme: {
      extend: {
        colors: {
          primary: {
            50: '#f0f9ff',
            100: '#e0f2fe',
            200: '#bae6fd',
            300: '#7dd3fc',
            400: '#38bdf8',
            500: '#0ea5e9',
            600: '#0284c7',
            700: '#0369a1',
            800: '#075985',
            900: '#0c4a6e',
          },
          pink: {
            50: '#fdf2f8', // Custom light pink
            100: '#fce7f3',
            200: '#fbcfe8',
            300: '#f9a8d4',
            400: '#f472b6',
            500: '#ec4899',
            600: '#db2777',
            700: '#be185d',
            800: '#9d174d',
            900: '#831843',
          },
          university: {
            primary: '#FFEEF2',  // Soft pink
            secondary: '#F0F7FF', // Soft blue
            accent: '#FFF5E6'     // Soft orange
          },
          peach: {
            100: '#ffe5b4', // light peach
            200: '#ffd1a3'  // darker peach
          },
          // ... rest of your color scheme
        },
      },
    },
    plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
      // ... other plugins
    ],
  }