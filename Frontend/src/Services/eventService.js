import axios from "axios";

export default {
  getAllEvents() {
    return axios.get("WorkshopEvents/getAll");
  },

  getEventById(id) {
    return axios.get(`WorkshopEvents/get/${id}`);
  },

  /**
   * Create a new event
   * @param {Object} eventData - The event data
   * @returns {Promise} Promise object representing the created event
   */
  createEvent(eventData) {
    let data = new FormData();
    data.append('nom', eventData.nom);
    data.append('description', eventData.description);
    data.append('date', eventData.date);
    data.append('lien', eventData.lien);
    data.append('image', eventData.image);
    console.log('Creating eventData:', data);
    return axios.post("http://localhost:8000/api/WorkshopEvents/create", data)

      .then(response => response.data)
      .catch(error => {
        console.error('Error creating eventData:', error);
        throw error;
      });
  },

  /**
   * Update an existing event
   * @param {Number} id - The ID of the event to update
   * @param {Object} eventData - The updated eventData data
   * @returns {Promise} Promise object representing the updated eventData
   */
  updateEvent(id, eventData) {
    let data = new FormData();
    data.append('nom', eventData.nom);
    data.append('description', eventData.description);
    data.append('date', eventData.date);
    data.append('lien', eventData.lien);
    if (eventData.image && eventData.image instanceof File) {
      data.append('image', eventData.image);
    }

    console.log('Updating eventData:', eventData);
    return axios.post(`http://localhost:8000/api/WorkshopEvents/update/${id}`, data)
      .then(response => response.data)
      .catch(error => {
        console.error('Error updating eventData:', error);
        throw error;
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
