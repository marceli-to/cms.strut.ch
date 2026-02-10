import { createRouter, createWebHistory } from 'vue-router'

import Components from '@/views/Components.vue'
import BlogIndex from '@/views/blog/Index.vue'
import BlogForm from '@/views/blog/Form.vue'

const routes = [
  {
    path: '/dashboard',
    redirect: '/dashboard/components',
  },
  {
    path: '/dashboard/components',
    name: 'components',
    component: Components,
    meta: { title: 'Components' },
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
    meta: { title: 'Blog' },
  },
  {
    path: '/dashboard/blog/:id/edit',
    name: 'blog.edit',
    component: BlogForm,
    meta: { title: 'Blog' },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.afterEach((to) => {
  document.title = to.meta.title
    ? `${to.meta.title} – DataHub`
    : 'DataHub'
})

export default router
