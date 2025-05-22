// src/services/statisticsService.js
import axios from "axios";

export const fetchStatistics = async (period = "year") => {
  try {
    const response = await axios.get(`http://localhost:8000/api/statistics?period=${period}`);
    return response.data.data; // Note the .data.data to access the nested data
  } catch (error) {
    console.error("Error fetching statistics:", error);
    return {
      users: 0,
      chapters: 0,
      tests: 0,
      quotes: 0
    };
  }
};