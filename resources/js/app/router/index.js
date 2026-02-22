import { createRouter, createWebHistory } from 'vue-router'

import Home from '@/views/Home.vue'
import ProjectIndex from '@/views/projects/Index.vue'
import ProjectForm from '@/views/projects/Form.vue'
import MediaIndex from '@/views/media/Index.vue'
import SettingsIndex from '@/views/settings/Index.vue'
import CategoryForm from '@/views/settings/CategoryForm.vue'

const routes = [
  {
    path: '/dashboard',
    name: 'home',
    component: Home,
    meta: { title: 'Dashboard' },
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
    path: '/dashboard/settings',
    name: 'settings.index',
    component: SettingsIndex,
    meta: { title: 'Einstellungen' },
  },
  {
    path: '/dashboard/settings/categories/create',
    name: 'settings.categories.create',
    component: CategoryForm,
    meta: { title: 'Neue Kategorie' },
  },
  {
    path: '/dashboard/settings/categories/:id/edit',
    name: 'settings.categories.edit',
    component: CategoryForm,
    meta: { title: 'Kategorie bearbeiten' },
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
