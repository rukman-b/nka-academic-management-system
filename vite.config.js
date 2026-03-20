
// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'

export default defineConfig({
  server: {
    host: '0.0.0.0',      // listen inside container
    port: 5173,
    // Allow the app at 8000 to load modules from 5173
    cors: {
      origin: [
        'http://localhost:8000', 
        'http://127.0.0.1:8000',
        'http://admin.nka.test:8000',
      ],
      methods: ['GET', 'HEAD', 'OPTIONS'],
      allowedHeaders: ['*'],
      credentials: false,
    },
    // HMR websocket should point at your host
    hmr: {
      host: 'localhost',
      port: 5173,
      protocol: 'ws',
    },
  },
  plugins: [
    laravel({
      
      input: [
        'resources/css/app.css', //Adminlte default styles
        'resources/js/app.js',  //Adminlte default js
        'resources/css/skins/student.css',     
        'resources/css/skins/employer.css',     
        'resources/css/skins/testuser.css',     
        'resources/scss/skins/student/student.scss',
      ],
      refresh: true,
      // hotFile: 'public/hot', // default
    }),
  ],
  resolve: {
    alias: {
      jquery: path.resolve(__dirname, 'resources/vendor/jquery/jquery.min.js'),
    },
  },
  optimizeDeps: {
    include: ['jquery'],
  },
})
