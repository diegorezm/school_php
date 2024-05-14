import axios from "axios";
const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL ?? "http://localhost:8000/api/v1",
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

export default http