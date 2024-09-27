'use client';
import React, { useState } from 'react';
import { Box, Typography, Grid, Card, CardContent, Button, IconButton, Avatar, List, ListItem, ListItemText, Drawer, ListItemIcon, Divider, Container } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import CheckCircleIcon from '@mui/icons-material/CheckCircle';
import CancelIcon from '@mui/icons-material/Cancel';
import MenuIcon from '@mui/icons-material/Menu';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import LogoutIcon from '@mui/icons-material/Logout';
import PeopleIcon from '@mui/icons-material/People';
import SettingsIcon from '@mui/icons-material/Settings';

const userRequests = [
    { id: 1, name: 'John Doe', role: 'Technician', email: 'johndoe@example.com' },
    { id: 2, name: 'Jane Smith', role: 'Support', email: 'janesmith@example.com' },
    { id: 3, name: 'Bob Johnson', role: 'Manager', email: 'bobjohnson@example.com' }
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

const AdminUserRequestsPage = () => {
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
                sx={{ position: 'fixed', top: 16, left: 16, color: '#1141c1' }}
            >
                <MenuIcon fontSize="large" />
            </IconButton>

            <Sidebar open={sidebarOpen} toggleSidebar={toggleSidebar} />

            <Box sx={{ flexGrow: 1, backgroundColor: '#f5f5f5', minHeight: '100vh', padding: 3, paddingLeft: 10 }}>
                <Container sx={{ marginTop: 4 }}>
                    <Typography variant="h4" align="center" gutterBottom sx={{ marginTop: 6, marginBottom: 6, fontWeight: 'bold', color: '#1141c1' }}>
                        User Creation Requests
                    </Typography>

                    <Grid container spacing={4}>
                        {userRequests.map((request) => (
                            <Grid item xs={12} md={6} key={request.id}>
                                <Card sx={{ boxShadow: 3 }}>
                                    <CardContent>
                                        <Typography variant="h6" sx={{ color: '#1141c1' }}>
                                            {request.name}
                                        </Typography>
                                        <Typography variant="body1" sx={{ color: '#555' }}>
                                            Role: {request.role}
                                        </Typography>
                                        <Typography variant="body1" sx={{ color: '#555' }}>
                                            Email: {request.email}
                                        </Typography>

                                        <Box sx={{ marginTop: 2, display: 'flex', justifyContent: 'space-between' }}>
                                            <Button
                                                variant="contained"
                                                color="primary"
                                                startIcon={<CheckCircleIcon />}
                                                sx={{ backgroundColor: '#1141c1' }}
                                            >
                                                Accept
                                            </Button>
                                            <Button
                                                variant="contained"
                                                color="secondary"
                                                startIcon={<CancelIcon />}
                                                sx={{ backgroundColor: '#FF6B35' }}
                                            >
                                                Reject
                                            </Button>
                                        </Box>
                                    </CardContent>
                                </Card>
                            </Grid>
                        ))}
                    </Grid>
                </Container>
            </Box>
        </Box>
    );
};

export default AdminUserRequestsPage;
