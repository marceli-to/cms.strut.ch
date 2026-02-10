import { createRouter, createWebHistory } from 'vue-router'

import Home from '@/views/Home.vue'
import BlogIndex from '@/views/blog/Index.vue'
import BlogForm from '@/views/blog/Form.vue'

const routes = [
  {
    path: '/dashboard',
    name: 'home',
    component: Home,
    meta: { title: 'Dashboard' },
  },
  {
    path: '/dashboard/blog',
    name: 'blog.index',
    component: BlogIndex,
    meta: { title: 'Blog' },
  },
  {
    path: '/dashboard/blog/create',
    name: 'blog.create',
    component: BlogForm,
    meta: { title: 'Neuer Beitrag' },
  },
  {
    path: '/dashboard/blog/:id/edit',
    name: 'blog.edit',
    component: BlogForm,
    meta: { title: 'Beitrag bearbeiten' },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.afterEach((to) => {
  const appName = document.title.split('–').pop()?.trim() || 'CMS'
  document.title = to.meta.title
    ? `${to.meta.title} – ${appName}`
    : appName
})

export default router
