'use client';
import React, { useState } from 'react';
import {
    Box, Typography, Grid, Card, CardContent, Button, IconButton,
    List, ListItem, ListItemText, Drawer, ListItemIcon, Divider,
    Avatar, Container, Dialog, DialogActions, DialogContent,
    DialogContentText, DialogTitle, TextField
} from '@mui/material';
import MenuIcon from '@mui/icons-material/Menu';
import PeopleIcon from '@mui/icons-material/People';
import AddIcon from '@mui/icons-material/Add';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import LogoutIcon from '@mui/icons-material/Logout';
import SettingsIcon from '@mui/icons-material/Settings';
import { deepOrange } from '@mui/material/colors';

const usersList = [
    { id: 1, name: 'John Doe', role: 'Admin', email: 'john.doe@carcare.com' },
    { id: 2, name: 'Jane Smith', role: 'Technician', email: 'jane.smith@carcare.com' },
    { id: 3, name: 'Peter Parker', role: 'Support', email: 'peter.parker@carcare.com' },
    { id: 4, name: 'Tony Stark', role: 'Manager', email: 'tony.stark@carcare.com' },
];

const Sidebar = ({ open, toggleSidebar }) => (
    <Drawer
        anchor="left"
        open={open}
        onClose={toggleSidebar(false)}
        sx={{
            '& .MuiDrawer-paper': {
                width: 240,
                backgroundColor: '#1141c1', 
                color: '#fff',
            },
        }}
    >
        <Box sx={{ textAlign: 'center', padding: 2 }}>
            <Avatar sx={{ bgcolor: deepOrange[500], width: 56, height: 56, margin: 'auto' }}>A</Avatar>
            <Typography variant="h6" sx={{ marginTop: 2 }}>Admin One</Typography>
        </Box>
        <Divider sx={{ backgroundColor: '#fff' }} />
        <List>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <HomeIcon />
                </ListItemIcon>
                <ListItemText primary="Home" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <PeopleIcon />
                </ListItemIcon>
                <ListItemText primary="Manage Users" />
            </ListItem>
            <ListItem button>
                <ListItemIcon sx={{ color: '#fff' }}>
                    <EventNoteIcon />
                </ListItemIcon>
                <ListItemText primary="Manage Bookings" />
            </ListItem>
        </List>
        <Divider sx={{ backgroundColor: '#fff' }} />
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
                <ListItemText primary="Settings" />
            </ListItem>
        </List>
    </Drawer>
);

const ManageUsersPage = () => {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [openDialog, setOpenDialog] = useState(false);
    const [editUser, setEditUser] = useState(null);
    const [users, setUsers] = useState(usersList);

    const toggleSidebar = (open) => (event) => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }
        setSidebarOpen(open);
    };

    const handleEditUser = (user) => {
        setEditUser(user);
        setOpenDialog(true);
    };

    const handleDeleteUser = (userId) => {
        setUsers(users.filter(user => user.id !== userId));
    };

    const handleDialogClose = () => {
        setEditUser(null);
        setOpenDialog(false);
    };

    const handleSaveUser = () => {
        setOpenDialog(false);
    };

    return (
        <Box sx={{ display: 'flex' }}>
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

            <Box sx={{ flexGrow: 1, backgroundColor: '#f5f5f5', minHeight: '100vh', padding: 4 }}>
                <Container sx={{ marginTop: 6 }}>
                    <Typography
                        variant="h4"
                        align="center"
                        gutterBottom
                        sx={{ fontFamily: 'Poppins, sans-serif', fontWeight: 'bold', color: '#1141c1' }}
                    >
                        Manage Users
                    </Typography>

                    <Button
                        variant="contained"
                        sx={{ backgroundColor: '#1141c1', color: 'white', marginBottom: 3, padding: '10px 20px' }}
                        onClick={() => setOpenDialog(true)}
                    >
                        <AddIcon sx={{ marginRight: 1 }} />
                        Add New User
                    </Button>

                    <Grid container spacing={4}>
                        {users.map(user => (
                            <Grid item xs={12} md={6} key={user.id}>
                                <Card sx={{ boxShadow: 4, borderRadius: 3 }}>
                                    <CardContent>
                                        <Typography variant="h6" sx={{ fontWeight: 'bold' }}>{user.name}</Typography>
                                        <Typography variant="body2" sx={{ marginTop: 1 }}>Role: {user.role}</Typography>
                                        <Typography variant="body2">Email: {user.email}</Typography>
                                        <Box sx={{ marginTop: 2, display: 'flex', justifyContent: 'flex-end' }}>
                                            <IconButton color="primary" onClick={() => handleEditUser(user)}>
                                                <EditIcon />
                                            </IconButton>
                                            <IconButton sx={{ color: 'red' }} onClick={() => handleDeleteUser(user.id)}>
                                                <DeleteIcon />
                                            </IconButton>
                                        </Box>
                                    </CardContent>
                                </Card>
                            </Grid>
                        ))}
                    </Grid>
                </Container>
            </Box>

            <Dialog open={openDialog} onClose={handleDialogClose} sx={{ '& .MuiPaper-root': { borderRadius: '15px' } }}>
                <DialogTitle>{editUser ? `Edit User: ${editUser.name}` : 'Add New User'}</DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        {editUser ? 'Modify the details of the user below.' : 'Enter the details for the new user.'}
                    </DialogContentText>
                    <TextField
                        autoFocus
                        margin="dense"
                        label="Name"
                        fullWidth
                        defaultValue={editUser ? editUser.name : ''}
                        sx={{ marginBottom: 2 }}
                    />
                    <TextField
                        margin="dense"
                        label="Role"
                        fullWidth
                        defaultValue={editUser ? editUser.role : ''}
                        sx={{ marginBottom: 2 }}
                    />
                    <TextField
                        margin="dense"
                        label="Email"
                        fullWidth
                        defaultValue={editUser ? editUser.email : ''}
                        sx={{ marginBottom: 2 }}
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleDialogClose} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleSaveUser} color="primary">
                        Save
                    </Button>
                </DialogActions>
            </Dialog>
        </Box>
    );
};

export default ManageUsersPage;
