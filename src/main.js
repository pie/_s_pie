// This file describes the build for the Nextgen portion of the theme. It
// compiles the scripts and styles required into dist/app.js and

import { createApp } from 'vue'
import App from './App.vue'

import '@/sass/app.scss';

createApp(App).mount('#app')