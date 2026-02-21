import { createRouter, createWebHistory } from 'vue-router'

import Home from '@/views/Home.vue'
import BlogIndex from '@/views/blog/Index.vue'
import BlogForm from '@/views/blog/Form.vue'
import ProjectIndex from '@/views/projects/Index.vue'
import ProjectForm from '@/views/projects/Form.vue'
import MediaIndex from '@/views/media/Index.vue'

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
    path: '/dashboard/projects',
    name: 'projects.index',
    component: ProjectIndex,
    meta: { title: 'Projekte' },
  },
  {
    path: '/dashboard/projects/create',
    name: 'projects.create',
    component: ProjectForm,
    meta: { title: 'Neues Projekt' },
  },
  {
    path: '/dashboard/projects/:id/edit',
    name: 'projects.edit',
    component: ProjectForm,
    meta: { title: 'Projekt bearbeiten' },
  },
  {
    path: '/dashboard/media',
    name: 'media.index',
    component: MediaIndex,
    meta: { title: 'Media' },
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
