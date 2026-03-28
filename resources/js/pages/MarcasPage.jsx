import React, { useState, useEffect } from 'react';
import { getMarcas, createMarca, updateMarca, deleteMarca } from '../services/api';

export default function MarcasPage() {
    const [marcas, setMarcas] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({ nombre: '', estado: true });
    const [error, setError] = useState('');
    const [success, setSuccess] = useState('');

    useEffect(() => {
        fetchMarcas();
    }, []);

    const fetchMarcas = async () => {
        try {
            setLoading(true);
            const response = await getMarcas();
            setMarcas(response.data);
        } catch (err) {
            setError('Error al cargar las marcas');
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
                await updateMarca(editingId, formData);
                setSuccess('Marca actualizada correctamente');
            } else {
                await createMarca(formData);
                setSuccess('Marca creada correctamente');
            }
            setFormData({ nombre: '', estado: true });
            setEditingId(null);
            setShowForm(false);
            fetchMarcas();
        } catch (err) {
            setError(err.response?.data?.message || 'Error al guardar la marca');
        }
    };

    const handleEdit = (marca) => {
        setEditingId(marca.id);
        setFormData({ nombre: marca.nombre, estado: marca.estado });
        setShowForm(true);
        setError('');
        setSuccess('');
    };

    const handleDelete = async (id) => {
        if (!window.confirm('¿Estás seguro de eliminar esta marca? (Soft Delete)')) return;
        try {
            await deleteMarca(id);
            setSuccess('Marca eliminada correctamente (Soft Delete)');
            fetchMarcas();
        } catch (err) {
            setError('Error al eliminar la marca');
        }
    };

    const handleCancel = () => {
        setShowForm(false);
        setEditingId(null);
        setFormData({ nombre: '', estado: true });
        setError('');
    };

    if (loading) return <div className="loading">Cargando marcas...</div>;

    return (
        <div className="page">
            <div className="page-header">
                <h1>Marcas</h1>
                <button
                    className="btn btn-primary"
                    onClick={() => {
                        setShowForm(true);
                        setEditingId(null);
                        setFormData({ nombre: '', estado: true });
                    }}
                >
                    + Nueva Marca
                </button>
            </div>

            {error && <div className="alert alert-error">{error}</div>}
            {success && <div className="alert alert-success">{success}</div>}

            {/* FORMULARIO CREAR / EDITAR */}
            {showForm && (
                <div className="form-container">
                    <h2>{editingId ? 'Editar Marca' : 'Nueva Marca'}</h2>
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="nombre">Nombre:</label>
                            <input
                                type="text"
                                id="nombre"
                                value={formData.nombre}
                                onChange={(e) => setFormData({ ...formData, nombre: e.target.value })}
                                required
                                placeholder="Nombre de la marca"
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
                        {marcas.length === 0 ? (
                            <tr>
                                <td colSpan="4" className="empty">No hay marcas registradas</td>
                            </tr>
                        ) : (
                            marcas.map((marca) => (
                                <tr key={marca.id}>
                                    <td>{marca.id}</td>
                                    <td>{marca.nombre}</td>
                                    <td>
                                        <span className={`badge ${marca.estado ? 'badge-active' : 'badge-inactive'}`}>
                                            {marca.estado ? 'Activo' : 'Inactivo'}
                                        </span>
                                    </td>
                                    <td className="actions">
                                        <button className="btn btn-edit" onClick={() => handleEdit(marca)}>
                                            Editar
                                        </button>
                                        <button className="btn btn-delete" onClick={() => handleDelete(marca.id)}>
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