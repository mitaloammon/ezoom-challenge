import axios from 'axios';

const API_BASE_URL = 'http://localhost:8080/api/notifications';

export interface Notification {
  id: number;
  user_id: number;
  title: string;
  message: string;
  date: string;
  time: string;
}

export async function fetchAllNotifications(): Promise<Notification[]> {
  const response = await axios.get(API_BASE_URL);
  return response.data;
}

export async function fetchNotificationsByUser(userId: number): Promise<Notification[]> {
  const response = await axios.get(`${API_BASE_URL}/${userId}`);
  return response.data;
}

export async function createNotification(notification: Omit<Notification, 'id' | 'date' | 'time'>): Promise<any> {
  const response = await axios.post(`${API_BASE_URL}/create`, notification);
  return response.data;
}
