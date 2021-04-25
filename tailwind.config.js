module.exports = {
    purge: [
        './app/**/*.php',
        './resources/**/*.php',
    ],
    darkMode: 'class', // or 'media' or 'class'
    theme: {
        extend: {},
        fontFamily: {
            sans: ['Circular Std Book', 'sans-serif'],
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}