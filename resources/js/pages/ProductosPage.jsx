import React, { useState, useEffect } from 'react';
import {
    getProductos, createProducto, updateProducto, deleteProducto,
    getMarcas, getProveedores
} from '../services/api';
import axios from 'axios';

export default function ProductosPage() {
    const [productos, setProductos] = useState([]);
    const [marcas, setMarcas] = useState([]);
    const [categorias, setCategorias] = useState([]);
    const [proveedores, setProveedores] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({
        nombre: '',
        precio: '',
        estado: true,
        marca_id: '',
        categoria_id: '',
        proveedor_id: '',
    });
    const [error, setError] = useState('');
    const [success, setSuccess] = useState('');

    useEffect(() => {
        fetchAll();
    }, []);

    const fetchAll = async () => {
        try {
            setLoading(true);
            const [prodRes, marcasRes, provRes, catRes] = await Promise.all([
                getProductos(),
                getMarcas(),
                getProveedores(),
                axios.get('/api/categorias'),
            ]);
            setProductos(prodRes.data);
            setMarcas(marcasRes.data);
            setProveedores(provRes.data);
            setCategorias(catRes.data);
        } catch (err) {
            setError('Error al cargar los datos');
        } finally {
            setLoading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setSuccess('');

        const dataToSend = {
            nombre: formData.nombre,
            precio: parseFloat(formData.precio),
            estado: formData.estado,
            marca_id: parseInt(formData.marca_id),
            categoria_id: parseInt(formData.categoria_id),
            proveedor_id: parseInt(formData.proveedor_id),
        };

        try {
            if (editingId) {
                await updateProducto(editingId, dataToSend);
                setSuccess('Producto actualizado correctamente');
            } else {
                await createProducto(dataToSend);
                setSuccess('Producto creado correctamente');
            }
            resetForm();
            fetchAll();
        } catch (err) {
            if (err.response?.data?.errors) {
                const messages = Object.values(err.response.data.errors).flat().join(', ');
                setError(messages);
            } else {
                setError(err.response?.data?.message || 'Error al guardar el producto');
            }
        }
    };

    const handleEdit = (producto) => {
        setEditingId(producto.id);
        setFormData({
            nombre: producto.nombre,
            precio: producto.precio,
            estado: producto.estado,
            marca_id: producto.marca_id,
            categoria_id: producto.categoria_id,
            proveedor_id: producto.proveedor_id,
        });
        setShowForm(true);
        setError('');
        setSuccess('');
    };

    const handleDelete = async (id) => {
        if (!window.confirm('¿Estás seguro de eliminar este producto? (Soft Delete)')) return;
        try {
            await deleteProducto(id);
            setSuccess('Producto eliminado correctamente (Soft Delete)');
            fetchAll();
        } catch (err) {
            setError('Error al eliminar el producto');
        }
    };

    const resetForm = () => {
        setShowForm(false);
        setEditingId(null);
        setFormData({
            nombre: '',
            precio: '',
            estado: true,
            marca_id: '',
            categoria_id: '',
            proveedor_id: '',
        });
        setError('');
    };

    if (loading) return <div className="loading">Cargando productos...</div>;

    return (
        <div className="page">
            <div className="page-header">
                <h1>Productos</h1>
                <button
                    className="btn btn-primary"
                    onClick={() => {
                        setShowForm(true);
                        setEditingId(null);
                        setFormData({
                            nombre: '', precio: '', estado: true,
                            marca_id: '', categoria_id: '', proveedor_id: '',
                        });
                    }}
                >
                    + Nuevo Producto
                </button>
            </div>

            {error && <div className="alert alert-error">{error}</div>}
            {success && <div className="alert alert-success">{success}</div>}

            {/* FORMULARIO CREAR / EDITAR */}
            {showForm && (
                <div className="form-container">
                    <h2>{editingId ? 'Editar Producto' : 'Nuevo Producto'}</h2>
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="nombre">Nombre:</label>
                            <input
                                type="text"
                                id="nombre"
                                value={formData.nombre}
                                onChange={(e) => setFormData({ ...formData, nombre: e.target.value })}
                                required
                                placeholder="Nombre del producto"
                            />
                        </div>
                        <div className="form-group">
                            <label htmlFor="precio">Precio:</label>
                            <input
                                type="number"
                                id="precio"
                                step="0.01"
                                min="0"
                                value={formData.precio}
                                onChange={(e) => setFormData({ ...formData, precio: e.target.value })}
                                required
                                placeholder="0.00"
                            />
                        </div>
                        <div className="form-group">
                            <label htmlFor="marca_id">Marca:</label>
                            <select
                                id="marca_id"
                                value={formData.marca_id}
                                onChange={(e) => setFormData({ ...formData, marca_id: e.target.value })}
                                required
                            >
                                <option value="">-- Seleccionar Marca --</option>
                                {marcas.map((m) => (
                                    <option key={m.id} value={m.id}>{m.nombre}</option>
                                ))}
                            </select>
                        </div>
                        <div className="form-group">
                            <label htmlFor="categoria_id">Categoría:</label>
                            <select
                                id="categoria_id"
                                value={formData.categoria_id}
                                onChange={(e) => setFormData({ ...formData, categoria_id: e.target.value })}
                                required
                            >
                                <option value="">-- Seleccionar Categoría --</option>
                                {categorias.map((c) => (
                                    <option key={c.id} value={c.id}>{c.nombre}</option>
                                ))}
                            </select>
                        </div>
                        <div className="form-group">
                            <label htmlFor="proveedor_id">Proveedor:</label>
                            <select
                                id="proveedor_id"
                                value={formData.proveedor_id}
                                onChange={(e) => setFormData({ ...formData, proveedor_id: e.target.value })}
                                required
                            >
                                <option value="">-- Seleccionar Proveedor --</option>
                                {proveedores.map((p) => (
                                    <option key={p.id} value={p.id}>{p.nombre}</option>
                                ))}
                            </select>
                        </div>
                        <div className="form-group">
                            <label className="checkbox-label">
                                <input
                                    type="checkbox"
                                    checked={formData.estado}
                                    onChange={(e) => setFormData({ ...formData, estado: e.target.checked })}
                                />
                                Activo
                            </label>
                        </div>
                        <div className="form-actions">
                            <button type="submit" className="btn btn-primary">
                                {editingId ? 'Actualizar' : 'Guardar'}
                            </button>
                            <button type="button" className="btn btn-secondary" onClick={resetForm}>
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            )}

            {/* TABLA DE LISTADO */}
            <div className="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Marca</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {productos.length === 0 ? (
                            <tr>
                                <td colSpan="8" className="empty">No hay productos registrados</td>
                            </tr>
                        ) : (
                            productos.map((producto) => (
                                <tr key={producto.id}>
                                    <td>{producto.id}</td>
                                    <td>{producto.nombre}</td>
                                    <td>${parseFloat(producto.precio).toFixed(2)}</td>
                                    <td>{producto.marca?.nombre || 'N/A'}</td>
                                    <td>{producto.categoria?.nombre || 'N/A'}</td>
                                    <td>{producto.proveedor?.nombre || 'N/A'}</td>
                                    <td>
                                        <span className={`badge ${producto.estado ? 'badge-active' : 'badge-inactive'}`}>
                                            {producto.estado ? 'Activo' : 'Inactivo'}
                                        </span>
                                    </td>
                                    <td className="actions">
                                        <button className="btn btn-edit" onClick={() => handleEdit(producto)}>
                                            Editar
                                        </button>
                                        <button className="btn btn-delete" onClick={() => handleDelete(producto.id)}>
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>
        </div>
    );
}