import React, { useState, useEffect } from 'react';
import { getProveedores, createProveedor, updateProveedor, deleteProveedor } from '../services/api';

export default function ProveedoresPage() {
    const [proveedores, setProveedores] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({ nombre: '', estado: true });
    const [error, setError] = useState('');
    const [success, setSuccess] = useState('');

    useEffect(() => {
        fetchProveedores();
    }, []);

    const fetchProveedores = async () => {
        try {
            setLoading(true);
            const response = await getProveedores();
            setProveedores(response.data);
        } catch (err) {
            setError('Error al cargar los proveedores');
        } finally {
            setLoading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setSuccess('');

        try {
            if (editingId) {
                await updateProveedor(editingId, formData);
                setSuccess('Proveedor actualizado correctamente');
            } else {
                await createProveedor(formData);
                setSuccess('Proveedor creado correctamente');
            }
            setFormData({ nombre: '', estado: true });
            setEditingId(null);
            setShowForm(false);
            fetchProveedores();
        } catch (err) {
            setError(err.response?.data?.message || 'Error al guardar el proveedor');
        }
    };

    const handleEdit = (proveedor) => {
        setEditingId(proveedor.id);
        setFormData({ nombre: proveedor.nombre, estado: proveedor.estado });
        setShowForm(true);
        setError('');
        setSuccess('');
    };

    const handleDelete = async (id) => {
        if (!window.confirm('¿Estás seguro de eliminar este proveedor? (Soft Delete)')) return;
        try {
            await deleteProveedor(id);
            setSuccess('Proveedor eliminado correctamente (Soft Delete)');
            fetchProveedores();
        } catch (err) {
            setError('Error al eliminar el proveedor');
        }
    };

    const handleCancel = () => {
        setShowForm(false);
        setEditingId(null);
        setFormData({ nombre: '', estado: true });
        setError('');
    };

    if (loading) return <div className="loading">Cargando proveedores...</div>;

    return (
        <div className="page">
            <div className="page-header">
                <h1>Proveedores</h1>
                <button
                    className="btn btn-primary"
                    onClick={() => {
                        setShowForm(true);
                        setEditingId(null);
                        setFormData({ nombre: '', estado: true });
                    }}
                >
                    + Nuevo Proveedor
                </button>
            </div>

            {error && <div className="alert alert-error">{error}</div>}
            {success && <div className="alert alert-success">{success}</div>}

            {/* FORMULARIO CREAR / EDITAR */}
            {showForm && (
                <div className="form-container">
                    <h2>{editingId ? 'Editar Proveedor' : 'Nuevo Proveedor'}</h2>
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="nombre">Nombre:</label>
                            <input
                                type="text"
                                id="nombre"
                                value={formData.nombre}
                                onChange={(e) => setFormData({ ...formData, nombre: e.target.value })}
                                required
                                placeholder="Nombre del proveedor"
                            />
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
                            <button type="button" className="btn btn-secondary" onClick={handleCancel}>
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
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {proveedores.length === 0 ? (
                            <tr>
                                <td colSpan="4" className="empty">No hay proveedores registrados</td>
                            </tr>
                        ) : (
                            proveedores.map((proveedor) => (
                                <tr key={proveedor.id}>
                                    <td>{proveedor.id}</td>
                                    <td>{proveedor.nombre}</td>
                                    <td>
                                        <span className={`badge ${proveedor.estado ? 'badge-active' : 'badge-inactive'}`}>
                                            {proveedor.estado ? 'Activo' : 'Inactivo'}
                                        </span>
                                    </td>
                                    <td className="actions">
                                        <button className="btn btn-edit" onClick={() => handleEdit(proveedor)}>
                                            Editar
                                        </button>
                                        <button className="btn btn-delete" onClick={() => handleDelete(proveedor.id)}>
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