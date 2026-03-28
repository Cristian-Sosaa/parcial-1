import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route, Link, NavLink } from 'react-router-dom';
import MarcasPage from './pages/MarcasPage';
import ProveedoresPage from './pages/ProveedoresPage';
import ProductosPage from './pages/ProductosPage';
import HomePage from './pages/HomePage';
import '../css/app.css';

function App() {
    return (
        <BrowserRouter>
            <div className="app-container">
                {/* NAVBAR */}
                <nav className="navbar">
                    <div className="navbar-brand">
                        <Link to="/">Inventario</Link>
                    </div>
                    <ul className="navbar-links">
                        <li>
                            <NavLink to="/" end className={({isActive}) => isActive ? 'active' : ''}>
                                Inicio
                            </NavLink>
                        </li>
                        <li>
                            <NavLink to="/marcas" className={({isActive}) => isActive ? 'active' : ''}>
                                Marcas
                            </NavLink>
                        </li>
                        <li>
                            <NavLink to="/proveedores" className={({isActive}) => isActive ? 'active' : ''}>
                                Proveedores
                            </NavLink>
                        </li>
                        <li>
                            <NavLink to="/productos" className={({isActive}) => isActive ? 'active' : ''}>
                                Productos
                            </NavLink>
                        </li>
                    </ul>
                </nav>

                {/* CONTENIDO */}
                <main className="main-content">
                    <Routes>
                        <Route path="/" element={<HomePage />} />
                        <Route path="/marcas" element={<MarcasPage />} />
                        <Route path="/proveedores" element={<ProveedoresPage />} />
                        <Route path="/productos" element={<ProductosPage />} />
                    </Routes>
                </main>
            </div>
        </BrowserRouter>
    );
}

const container = document.getElementById('app');
const root = createRoot(container);
root.render(<App />);