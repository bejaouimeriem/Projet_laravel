import axios from "axios";

const API_URL = 'http://localhost:8000/api/WorkshopEvents';

export default {
  getAllEvents() {
    return axios.get("WorkshopEvents/getAll");
  },

  getEventById(id) {
    return axios.get(`WorkshopEvents/get/${id}`);
  },

  createEvent(eventData) {
    return axios.post(`${API_URL}/create`, eventData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },
  updateEvent(id, eventData) {
    return axios.post(`${API_URL}/update/${id}`, eventData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },

  deleteEvent(id) {
    return axios.delete(`WorkshopEvents/delete/${id}`);
  },

  deleteAllEvents() {
    return axios.delete("WorkshopEvents/deleteAll");
  },

  deleteExpiredEvents() {
    return axios.delete("WorkshopEvents/deleteExpired");
  },
};
