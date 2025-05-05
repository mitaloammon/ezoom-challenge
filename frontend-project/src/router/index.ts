import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import NotificationPage from '../views/NotificationPage.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/notifications'
  },
  {
    path: '/notifications',
    name: 'Notifications',
    component: NotificationPage
  },
  {
    path: '/notifications/:id',
    name: 'NotificationDetail',
    component: () => import('../views/ViewNotificationPage.vue')
  }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;
