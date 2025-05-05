import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import NotificationPage from '../views/NotificationPage.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/notification'
  },
  {
    path: '/notification',
    name: 'Notifications',
    component: NotificationPage
  },
  {
    path: '/message/:id',
    component: () => import('../views/ViewNotificationPage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
