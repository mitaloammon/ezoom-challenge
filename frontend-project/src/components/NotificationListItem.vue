<template>
  <ion-item
    v-if="notification"
    :routerLink="'/notifications/' + notification.id"
    :detail="false"
    class="list-item"
  >
    <div slot="start" class="dot dot-unread"></div>

    <ion-label class="ion-text-wrap">
      <h2>
        Usuário {{ notification.user_id }}
        <span class="date">
          <ion-note>{{ notification.date }} | {{ notification.time }}</ion-note>
          
          <ion-icon aria-hidden="true" :icon="chevronForward" size="small" v-if="isIos()" />
        </span>
      </h2>
      <h3>  {{ notification.title }}</h3>
      <p> {{ notification.message }}</p>
    </ion-label>
  </ion-item>
</template>

<script setup lang="ts">
import { IonIcon, IonItem, IonLabel, IonNote } from '@ionic/vue';
import { chevronForward } from 'ionicons/icons';

interface Notification {
  id: number;
  user_id: number;
  title: string;
  message: string;
  date: string;
  time: string;
}

defineProps<{
  notification: Notification;
}>();

const isIos = () => {
  const win = window as any;
  return win && win.Ionic && win.Ionic.mode === 'ios';
};

</script>

<style scoped>
.list-item {
  --padding-start: 0;
  --inner-padding-end: 0;
}

.list-item ion-label {
  margin-top: 12px;
  margin-bottom: 12px;
}

.list-item h2 {
  font-weight: 600;
  margin: 0;
  
  /**
   * With larger font scales
   * the date/time should wrap to the next
   * line. However, there should be
   * space between the name and the date/time
   * if they can appear on the same line.
   */
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.list-item p {
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
  width: 95%;
}

.list-item .date {
  align-items: center;
  display: flex;
}

.list-item ion-icon {
  color: #c9c9ca;
}

.list-item ion-note {
  font-size: 0.9375rem;
  margin-right: 8px;
  font-weight: normal;
}

.list-item ion-note.md {
  margin-right: 14px;
}

.list-item .dot {
  display: block;
  height: 12px;
  width: 12px;
  border-radius: 50%;
  align-self: start;
  margin: 16px 10px 16px 16px;
}

.list-item .dot-unread {
  background: var(--ion-color-primary);
}
</style>
