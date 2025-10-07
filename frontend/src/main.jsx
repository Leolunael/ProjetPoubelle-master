import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./index.css";
import App from "./App.jsx";

// composants
import Header from "./components/Header.jsx";
import Footer from "./components/Footer.jsx";

// import des pages
import Signaler from "./pages/Signaler.jsx";
import Calendrier from "./pages/Calendrier.jsx";
import Recyclage from "./pages/Recyclage.jsx";
import Renseigner from "./pages/Renseigner.jsx";
import Login from "./pages/Login.jsx";
import Register from "./pages/Register.jsx";

createRoot(document.getElementById("root")).render(
  <StrictMode>
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path="/" element={<App />} />
        <Route path="/signaler" element={<Signaler />} />
        <Route path="/calendrier" element={<Calendrier />} />
        <Route path="/recyclage" element={<Recyclage />} />
        <Route path="/renseigner" element={<Renseigner />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>
      <Footer />
    </BrowserRouter>
  </StrictMode>,
);
