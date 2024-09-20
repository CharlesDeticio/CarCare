'use client';
import React from 'react';
import { AppBar, Toolbar, Box, Typography, Grid, Card, CardContent, Button, Avatar, IconButton, List, ListItem, ListItemText, Container } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';
import TrendingUpIcon from '@mui/icons-material/TrendingUp';
import BuildIcon from '@mui/icons-material/Build';
import AssignmentIcon from '@mui/icons-material/Assignment';

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

const Dashboard = () => {
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
                    <IconButton color="inherit" href='' sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <InventoryIcon />
                    </IconButton>
                    <Avatar sx={{ bgcolor: deepOrange[500] }} href='/userprofile'>N</Avatar>
                </Toolbar>
            </AppBar>

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
    );
};

export default Dashboard;
