import React from 'react';
import { Link } from 'react-router-dom';

export default function HomePage() {
    return (
        <div className="home-page">
            <h1>Sistema de Inventario</h1>
            <p>Parcial 2 — Interfaz gráfica con React</p>
            <div className="card-grid">
                <Link to="/marcas" className="card">
                    <h2>Marcas</h2>
                    <p>Listar, agregar, editar y eliminar marcas</p>
                </Link>
                <Link to="/proveedores" className="card">
                    <h2>Proveedores</h2>
                    <p>Listar, agregar, editar y eliminar proveedores</p>
                </Link>
                <Link to="/productos" className="card">
                    <h2>Productos</h2>
                    <p>Listar, agregar, editar y eliminar productos</p>
                </Link>
            </div>
        </div>
    );
}