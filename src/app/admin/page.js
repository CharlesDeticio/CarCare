'use client';
import React, { useState } from 'react';
import { Box, Typography, Grid, Card, CardContent, Button, Avatar, IconButton, List, ListItem, ListItemText, Drawer, ListItemIcon, Divider, Container } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import MenuIcon from '@mui/icons-material/Menu';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import LogoutIcon from '@mui/icons-material/Logout';
import PeopleIcon from '@mui/icons-material/People';
import AssignmentIndIcon from '@mui/icons-material/AssignmentInd';
import SettingsIcon from '@mui/icons-material/Settings';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';

const shopName = "CarCare Service Center";

const adminUsers = [
    { id: 1, name: 'Admin One', role: 'Manager', email: 'admin1@carcare.com' },
    { id: 2, name: 'Admin Two', role: 'Technician', email: 'admin2@carcare.com' },
    { id: 3, name: 'Admin Three', role: 'Support', email: 'admin3@carcare.com' }
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

const AdminPage = () => {
    const [sidebarOpen, setSidebarOpen] = useState(false);

    const toggleSidebar = (open) => (event) => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }
        setSidebarOpen(open);
    };

    return (
        <Box sx={{ display: 'flex' }}>
            <IconButton
                edge="start"
                color="inherit"
                aria-label="menu"
                onClick={toggleSidebar(true)}
                sx={{ position: 'fixed', top: 16, left: 16, color: '#1141c1' }} // Primary color
            >
                <MenuIcon fontSize="large" />
            </IconButton>

            <Sidebar open={sidebarOpen} toggleSidebar={toggleSidebar} />

            <Box sx={{ flexGrow: 1, backgroundColor: '#f5f5f5', minHeight: '100vh', padding: 3, paddingLeft: 10 }}>
                <Container sx={{ marginTop: 4 }}>
                    <Typography variant="h4" align="center" gutterBottom sx={{ marginTop: 6, marginBottom: 6, fontWeight: 'bold', color: '#1141c1' }}>
                        {shopName} Admin Panel
                    </Typography>

                    <Grid container spacing={4}>
                        <Grid item xs={12} md={8}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom sx={{ color: '#333' }}>
                                        Admin Users
                                    </Typography>
                                    <List>
                                        {adminUsers.map((user) => (
                                            <ListItem key={user.id}>
                                                <ListItemText
                                                    primary={`${user.name} - ${user.role}`}
                                                    secondary={`Email: ${user.email}`}
                                                />
                                                <IconButton color="primary" sx={{ marginRight: 2 }}>
                                                    <EditIcon />
                                                </IconButton>
                                                <IconButton sx={{ color: 'red' }}>
                                                    <DeleteIcon />
                                                </IconButton>
                                            </ListItem>
                                        ))}
                                    </List>
                                </CardContent>
                            </Card>
                        </Grid>

                        <Grid item xs={12} md={4}>
                            <Card sx={{ boxShadow: 3, padding: 2 }}>
                                <Typography variant="h6" gutterBottom sx={{ color: '#333' }}>
                                    Quick Actions
                                </Typography>
                                <Button variant="contained" sx={{ backgroundColor: '#FF6B35', color: 'white', marginBottom: 2 }} fullWidth>
                                    <AssignmentIndIcon sx={{ marginRight: 1 }} />
                                    Accept New Users
                                </Button>
                                <Button variant="contained" sx={{ backgroundColor: '#1141c1', color: 'white' }} fullWidth>
                                    <SettingsIcon sx={{ marginRight: 1 }} />
                                    Settings
                                </Button>
                            </Card>
                        </Grid>
                    </Grid>
                </Container>
            </Box>
        </Box>
    );
};

export default AdminPage;
