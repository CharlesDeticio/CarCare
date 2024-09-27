'use client';
import React, { useState } from 'react';
import { AppBar, Toolbar, Box, Typography, IconButton, Avatar, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper, Button, Dialog, DialogActions, DialogContent, DialogTitle, TextField, Input, Drawer, List, ListItem, ListItemIcon, ListItemText } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import MenuIcon from '@mui/icons-material/Menu';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';
import SettingsIcon from '@mui/icons-material/Settings';
import BuildIcon from '@mui/icons-material/Build';
import LogoutIcon from '@mui/icons-material/Logout';

const shopName = "CarCare Service Center";

const initialInventory = [
    { id: 1, itemName: 'Oil Filter', category: 'Engine Parts', quantity: 50, price: 15.99, imageUrl: '' },
    { id: 2, itemName: 'Brake Pads', category: 'Brake System', quantity: 30, price: 45.50, imageUrl: '' },
    { id: 3, itemName: 'Car Battery', category: 'Electrical System', quantity: 20, price: 120.00, imageUrl: '' },
    { id: 4, itemName: 'Tire', category: 'Wheels', quantity: 10, price: 89.99, imageUrl: '' },
];

const Sidebar = ({ open, toggleSidebar }) => (
    <Drawer
        anchor="left"
        open={open}
        onClose={toggleSidebar(false)}
        sx={{
            '& .MuiDrawer-paper': {
                width: 240,
                backgroundColor: '#0d2a7c',
                color: '#fff',
            },
        }}
    >
        <Box sx={{ textAlign: 'center', padding: 2 }}>
            <Avatar sx={{ bgcolor: deepOrange[500], width: 56, height: 56, margin: 'auto' }}>N</Avatar>
            <Typography variant="h6" sx={{ marginTop: 2 }}>Dashboard</Typography>
        </Box>
        <div />
        <List>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <HomeIcon />
                </ListItemIcon>
                <ListItemText primary="Home" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <EventNoteIcon />
                </ListItemIcon>
                <ListItemText primary="Bookings" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <InventoryIcon />
                </ListItemIcon>
                <ListItemText primary="Inventory" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <BuildIcon />
                </ListItemIcon>
                <ListItemText primary="Services" />
            </ListItem>
        </List>
        <div />
        <List>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <LogoutIcon />
                </ListItemIcon>
                <ListItemText primary="Logout" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <SettingsIcon />
                </ListItemIcon>
                <ListItemText primary="Setting" />
            </ListItem>
        </List>
    </Drawer>
);

const InventoryPage = () => {
    const [inventory, setInventory] = useState(initialInventory);
    const [open, setOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [newItem, setNewItem] = useState({ itemName: '', category: '', quantity: '', price: '', imageUrl: '' });
    const [editItem, setEditItem] = useState(null);
    const [sidebarOpen, setSidebarOpen] = useState(false); // State for sidebar

    const toggleSidebar = (open) => (event) => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }
        setSidebarOpen(open);
    };

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
        <Box sx={{ display: 'flex', backgroundColor: '#f0f0f0', minHeight: '100vh' }}>

            <IconButton
                edge="start"
                color="inherit"
                aria-label="menu"
                onClick={toggleSidebar(true)}
                sx={{ position: 'fixed', top: 16, left: 16 }}
            >
                <MenuIcon fontSize="large" />
            </IconButton>

            <Sidebar open={sidebarOpen} toggleSidebar={toggleSidebar} />

            <Box sx={{ flexGrow: 1, padding: 3, paddingLeft: 10 }}>

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
                                        <TableCell align="right">{item.price}</TableCell>
                                        <TableCell>
                                            {item.imageUrl ? <img src={item.imageUrl} alt={item.itemName} style={{ width: 50, height: 50 }} /> : 'No Image'}
                                        </TableCell>
                                        <TableCell>
                                            <IconButton onClick={() => handleEditOpen(item)}>
                                                <EditIcon color="primary" />
                                            </IconButton>
                                            <IconButton onClick={() => handleDeleteItem(item.id)}>
                                                <DeleteIcon sx={{ color: 'red' }} />
                                            </IconButton>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </TableContainer>

                    <Dialog open={open} onClose={handleClose}>
                        <DialogTitle>Add New Item</DialogTitle>
                        <DialogContent>
                            <TextField autoFocus margin="dense" name="itemName" label="Item Name" type="text" fullWidth value={newItem.itemName} onChange={handleChange} />
                            <TextField margin="dense" name="category" label="Category" type="text" fullWidth value={newItem.category} onChange={handleChange} />
                            <TextField margin="dense" name="quantity" label="Quantity" type="number" fullWidth value={newItem.quantity} onChange={handleChange} />
                            <TextField margin="dense" name="price" label="Price" type="number" fullWidth value={newItem.price} onChange={handleChange} />
                            <Input margin="dense" name="image" type="file" fullWidth onChange={handleImageUpload} />
                        </DialogContent>
                        <DialogActions>
                            <Button onClick={handleClose} color="secondary">Cancel</Button>
                            <Button onClick={handleAddItem} color="primary">Add</Button>
                        </DialogActions>
                    </Dialog>


                    {editItem && (
                        <Dialog open={editOpen} onClose={handleEditClose}>
                            <DialogTitle>Edit Item</DialogTitle>
                            <DialogContent>
                                <TextField autoFocus margin="dense" name="itemName" label="Item Name" type="text" fullWidth value={editItem.itemName} onChange={handleEditChange} />
                                <TextField margin="dense" name="category" label="Category" type="text" fullWidth value={editItem.category} onChange={handleEditChange} />
                                <TextField margin="dense" name="quantity" label="Quantity" type="number" fullWidth value={editItem.quantity} onChange={handleEditChange} />
                                <TextField margin="dense" name="price" label="Price" type="number" fullWidth value={editItem.price} onChange={handleEditChange} />
                                <Input margin="dense" name="image" type="file" fullWidth onChange={handleEditImageUpload} />
                            </DialogContent>
                            <DialogActions>
                                <Button onClick={handleEditClose} color="secondary">Cancel</Button>
                                <Button onClick={handleUpdateItem} color="primary">Save</Button>
                            </DialogActions>
                        </Dialog>
                    )}
                </Box>
            </Box>
        </Box>
    );
};

export default InventoryPage;
