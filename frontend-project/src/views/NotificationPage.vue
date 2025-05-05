<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Notificações</ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true">
      <ion-refresher slot="fixed" @ionRefresh="refresh">
        <ion-refresher-content></ion-refresher-content>
      </ion-refresher>

      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Notificações</ion-title>
        </ion-toolbar>
      </ion-header>

      <ion-list>
        <NotificationListItem
          v-for="notification in notifications"
          :key="notification.id"
          :notification="notification"
        />
      </ion-list>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import {
  IonContent,
  IonHeader,
  IonList,
  IonPage,
  IonRefresher,
  IonRefresherContent,
  IonTitle,
  IonToolbar,
} from '@ionic/vue';

import { ref, onMounted } from 'vue';
import NotificationListItem from '@/components/NotificationListItem.vue';
import axios from 'axios';

interface Notification {
  id: number;
  user_id: number;
  title: string;
  message: string;
  date: string;
  time: string;
}

const notifications = ref<Notification[]>([]);
const API_URL = 'http://localhost:8080/api/notifications';

const fetchNotifications = async () => {
  try {
    const response = await axios.get<Notification[]>(API_URL);
    notifications.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar notificações:', error);
  }
};

const refresh = async (event: CustomEvent) => {
  await fetchNotifications();
  event.detail.complete();
};

onMounted(fetchNotifications);
</script>
