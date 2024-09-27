'use client';
import React, { useState } from 'react';
import { Box, Typography, Grid, Card, CardContent, Button, Avatar, IconButton, List, ListItem, ListItemText, Drawer, ListItemIcon, Divider, Container } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import MenuIcon from '@mui/icons-material/Menu';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';
import TrendingUpIcon from '@mui/icons-material/TrendingUp';
import BuildIcon from '@mui/icons-material/Build';
import AssignmentIcon from '@mui/icons-material/Assignment';
import LogoutIcon from '@mui/icons-material/Logout';
import SettingsIcon from '@mui/icons-material/Settings';

const shopName = "CarCare Service Center";
const bookings = [
    { customer: 'John Doe', service: 'Oil Change', date: '2024-09-21', status: 'In Progress' },
    { customer: 'Jane Smith', service: 'Tire Rotation', date: '2024-09-22', status: 'Completed' },
    { customer: 'Sam Wilson', service: 'Brake Maintenance', date: '2024-09-20', status: 'Pending' },
];

const revenue = 1250;
const availableServices = [
    'Oil Change',
    'Brake Maintenance',
    'Engine Repair',
    'Tire Rotation',
    'Battery Replacement'
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

const Dashboard = () => {
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
                sx={{ position: 'fixed', top: 16, left: 16 }}
            >
                <MenuIcon fontSize="large" />
            </IconButton>


            <Sidebar open={sidebarOpen} toggleSidebar={toggleSidebar} />


            <Box sx={{ flexGrow: 1, backgroundColor: '#f0f0f0', minHeight: '100vh', padding: 3, paddingLeft: 10 }}>
                <Container sx={{ marginTop: 4 }}>
                    <Typography variant="h4" align="center" gutterBottom sx={{ marginTop: 6, marginBottom: 6, backgroundColor: '#f3f3f3', fontFamily: 'Arial', fontWeight: 'bold' }}>
                        Welcome to {shopName} Dashboard
                    </Typography>

                    <Grid container spacing={4}>
                        <Grid item xs={12} md={8}>
                            <Grid container spacing={4}>
                                <Grid item xs={12} sm={6}>
                                    <Card sx={{ backgroundColor: '#1141c1', color: 'white', boxShadow: 3 }}>
                                        <CardContent>
                                            <Typography variant="h6" gutterBottom>
                                                Total Revenue
                                            </Typography>
                                            <Typography variant="h4">${revenue}</Typography>
                                            <IconButton sx={{ color: 'white', marginTop: 2 }}>
                                                <TrendingUpIcon fontSize="large" />
                                            </IconButton>
                                        </CardContent>
                                    </Card>
                                </Grid>

                                <Grid item xs={12} sm={6}>
                                    <Card sx={{ backgroundColor: '#1141c1', color: 'white', boxShadow: 3 }}>
                                        <CardContent>
                                            <Typography variant="h6" gutterBottom>
                                                Ongoing Services
                                            </Typography>
                                            <Typography variant="h4">{bookings.filter(b => b.status === 'In Progress').length}</Typography>
                                            <IconButton sx={{ color: 'white', marginTop: 2 }}>
                                                <BuildIcon fontSize="large" />
                                            </IconButton>
                                        </CardContent>
                                    </Card>
                                </Grid>
                            </Grid>

                            <Grid item xs={12} sx={{ marginTop: 4 }}>
                                <Card sx={{ boxShadow: 3 }}>
                                    <CardContent>
                                        <Typography variant="h6" gutterBottom>
                                            Recent Bookings
                                        </Typography>
                                        <List>
                                            {bookings.map((booking, index) => (
                                                <ListItem key={index}>
                                                    <ListItemText
                                                        primary={`${booking.customer} - ${booking.service}`}
                                                        secondary={`Date: ${booking.date} | Status: ${booking.status}`}
                                                    />
                                                </ListItem>
                                            ))}
                                        </List>
                                    </CardContent>
                                </Card>
                            </Grid>
                        </Grid>

                        <Grid item xs={12} md={4}>
                            <Card sx={{ boxShadow: 3, padding: 2 }}>
                                <Typography variant="h6" gutterBottom>
                                    Available Services
                                </Typography>
                                <List>
                                    {availableServices.map((service, index) => (
                                        <ListItem key={index}>
                                            <ListItemText primary={service} />
                                        </ListItem>
                                    ))}
                                </List>
                            </Card>

                            <Card sx={{ boxShadow: 3, padding: 2, marginTop: 4 }}>
                                <Typography variant="h6" gutterBottom>
                                    Quick Actions
                                </Typography>
                                <Button variant="contained" sx={{ backgroundColor: '#1141c1', color: 'white', marginBottom: 2 }} fullWidth>
                                    <AssignmentIcon sx={{ marginRight: 1 }} />
                                    Manage Bookings
                                </Button>
                                <Button variant="contained" sx={{ backgroundColor: '#1141c1', color: 'white' }} fullWidth>
                                    <BuildIcon sx={{ marginRight: 1 }} />
                                    Add New Service
                                </Button>
                            </Card>
                        </Grid>
                    </Grid>
                </Container>
            </Box>
        </Box>
    );
};

export default Dashboard;
