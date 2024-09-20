'use client';
import React, { useState } from 'react';
import { AppBar, Toolbar, Box, Typography, IconButton, Avatar, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper, Button, Dialog, DialogActions, DialogContent, DialogTitle, TextField, Input } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';

const shopName = "CarCare Service Center";

const initialInventory = [
    { id: 1, itemName: 'Oil Filter', category: 'Engine Parts', quantity: 50, price: 15.99, imageUrl: '' },
    { id: 2, itemName: 'Brake Pads', category: 'Brake System', quantity: 30, price: 45.50, imageUrl: '' },
    { id: 3, itemName: 'Car Battery', category: 'Electrical System', quantity: 20, price: 120.00, imageUrl: '' },
    { id: 4, itemName: 'Tire', category: 'Wheels', quantity: 10, price: 89.99, imageUrl: '' },
];

const InventoryPage = () => {
    const [inventory, setInventory] = useState(initialInventory);
    const [open, setOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [newItem, setNewItem] = useState({ itemName: '', category: '', quantity: '', price: '', imageUrl: '' });
    const [editItem, setEditItem] = useState(null);

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
        setNewItem({ itemName: '', category: '', quantity: '', price: '', imageUrl: '' });
    };

    const handleEditOpen = (item) => {
        setEditItem(item);
        setEditOpen(true);
    };

    const handleEditClose = () => {
        setEditOpen(false);
        setEditItem(null);
    };

    const handleAddItem = () => {
        const newId = inventory.length > 0 ? inventory[inventory.length - 1].id + 1 : 1;
        const itemToAdd = { ...newItem, id: newId, quantity: Number(newItem.quantity), price: Number(newItem.price) };
        setInventory([...inventory, itemToAdd]);
        handleClose();
    };

    const handleUpdateItem = () => {
        const updatedInventory = inventory.map((item) => (item.id === editItem.id ? editItem : item));
        setInventory(updatedInventory);
        handleEditClose();
    };

    const handleDeleteItem = (id) => {
        const updatedInventory = inventory.filter((item) => item.id !== id);
        setInventory(updatedInventory);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setNewItem({ ...newItem, [name]: value });
    };

    const handleEditChange = (e) => {
        const { name, value } = e.target;
        setEditItem({ ...editItem, [name]: value });
    };

    const handleImageUpload = (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onloadend = () => {
            setNewItem({ ...newItem, imageUrl: reader.result });
        };
        reader.readAsDataURL(file);
    };

    const handleEditImageUpload = (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onloadend = () => {
            setEditItem({ ...editItem, imageUrl: reader.result });
        };
        reader.readAsDataURL(file);
    };

    return (
        <Box sx={{ backgroundColor: '#f0f0f0', minHeight: '100vh', padding: 3 }}>
            <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' }}>
                <Toolbar>
                    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                        {shopName} Dashboard
                    </Typography>
                    <IconButton color="inherit" sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <HomeIcon />
                    </IconButton>
                    <IconButton color="inherit" sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <EventNoteIcon />
                    </IconButton>
                    <IconButton color="inherit" sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <InventoryIcon />
                    </IconButton>
                    <Avatar sx={{ bgcolor: deepOrange[500] }} href='/userprofile'>N</Avatar>
                </Toolbar>
            </AppBar>

            <Box sx={{ padding: 3 }}>
                <Typography variant="h4" align="center" gutterBottom sx={{ fontWeight: 'bold', marginBottom: 4 }}>
                    Inventory Management
                </Typography>

                <Box sx={{ textAlign: 'right', marginBottom: 3 }}>
                    <Button variant="contained" color="primary" onClick={handleClickOpen} sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}>
                        Add New Item
                    </Button>
                </Box>

                <TableContainer component={Paper}>
                    <Table sx={{ minWidth: 650 }} aria-label="inventory table">
                        <TableHead>
                            <TableRow>
                                <TableCell>Item Name</TableCell>
                                <TableCell>Category</TableCell>
                                <TableCell align="right">Quantity</TableCell>
                                <TableCell align="right">Price ($)</TableCell>
                                <TableCell>Image</TableCell>
                                <TableCell>Actions</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {inventory.map((item) => (
                                <TableRow key={item.id}>
                                    <TableCell>{item.itemName}</TableCell>
                                    <TableCell>{item.category}</TableCell>
                                    <TableCell align="right">{item.quantity}</TableCell>
                                    <TableCell align="right">{item.price.toFixed(2)}</TableCell>
                                    <TableCell>
                                        {item.imageUrl ? <img src={item.imageUrl} alt={item.itemName} style={{ width: 50, height: 50 }} /> : 'No Image'}
                                    </TableCell>
                                    <TableCell>
                                        <IconButton onClick={() => handleEditOpen(item)} color="primary">
                                            <EditIcon />
                                        </IconButton>
                                        <IconButton onClick={() => handleDeleteItem(item.id)} color="error">
                                            <DeleteIcon />
                                        </IconButton>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>

                <Dialog open={open} onClose={handleClose}>
                    <DialogTitle>Add New Inventory Item</DialogTitle>
                    <DialogContent>
                        <TextField
                            autoFocus
                            margin="dense"
                            label="Item Name"
                            name="itemName"
                            value={newItem.itemName}
                            onChange={handleChange}
                            fullWidth
                            variant="outlined"
                        />
                        <TextField
                            margin="dense"
                            label="Category"
                            name="category"
                            value={newItem.category}
                            onChange={handleChange}
                            fullWidth
                            variant="outlined"
                        />
                        <TextField
                            margin="dense"
                            label="Quantity"
                            name="quantity"
                            value={newItem.quantity}
                            onChange={handleChange}
                            type="number"
                            fullWidth
                            variant="outlined"
                        />
                        <TextField
                            margin="dense"
                            label="Price"
                            name="price"
                            value={newItem.price}
                            onChange={handleChange}
                            type="number"
                            fullWidth
                            variant="outlined"
                        />
                        <Input
                            type="file"
                            onChange={handleImageUpload}
                            fullWidth
                            sx={{ marginTop: 2 }}
                        />
                    </DialogContent>
                    <DialogActions>
                        <Button onClick={handleClose} color="primary">
                            Cancel
                        </Button>
                        <Button onClick={handleAddItem} color="primary" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}>
                            Add Item
                        </Button>
                    </DialogActions>
                </Dialog>

                {editItem && (
                    <Dialog open={editOpen} onClose={handleEditClose}>
                        <DialogTitle>Edit Inventory Item</DialogTitle>
                        <DialogContent>
                            <TextField
                                autoFocus
                                margin="dense"
                                label="Item Name"
                                name="itemName"
                                value={editItem.itemName}
                                onChange={handleEditChange}
                                fullWidth
                                variant="outlined"
                            />
                            <TextField
                                margin="dense"
                                label="Category"
                                name="category"
                                value={editItem.category}
                                onChange={handleEditChange}
                                fullWidth
                                variant="outlined"
                            />
                            <TextField
                                margin="dense"
                                label="Quantity"
                                name="quantity"
                                value={editItem.quantity}
                                onChange={handleEditChange}
                                type="number"
                                fullWidth
                                variant="outlined"
                            />
                            <TextField
                                margin="dense"
                                label="Price"
                                name="price"
                                value={editItem.price}
                                onChange={handleEditChange}
                                type="number"
                                fullWidth
                                variant="outlined"
                            />
                            <Input
                                type="file"
                                onChange={handleEditImageUpload}
                                fullWidth
                                sx={{ marginTop: 2 }}
                            />
                            {editItem.imageUrl && (
                                <Box sx={{ marginTop: 2 }}>
                                    <img src={editItem.imageUrl} alt={editItem.itemName} style={{ width: 100, height: 100 }} />
                                </Box>
                            )}
                        </DialogContent>
                        <DialogActions>
                            <Button onClick={handleEditClose} color="primary">
                                Cancel
                            </Button>
                            <Button onClick={handleUpdateItem} color="primary" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}>
                                Update Item
                            </Button>
                        </DialogActions>
                    </Dialog>
                )}
            </Box>
        </Box>
    );
};

export default InventoryPage;
