'use client';
import React, { useState } from 'react';
import { Box, Typography, Grid, Card, CardContent, IconButton, Avatar, Button, TextField, MenuItem, Chip, Drawer, List, ListItem, ListItemText, ListItemIcon } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';
import DeleteIcon from '@mui/icons-material/Delete';
import MenuIcon from '@mui/icons-material/Menu';
import LogoutIcon from '@mui/icons-material/Logout';
import SettingsIcon from '@mui/icons-material/Settings';
import BuildIcon from '@mui/icons-material/Build';

const shopName = "CarCare Service Center";

const initialBookings = [
    { customer: 'John Doe', service: 'Oil Change', date: '2024-09-21', status: 'In Progress' },
    { customer: 'Jane Smith', service: 'Tire Rotation', date: '2024-09-22', status: 'Completed' },
    { customer: 'Sam Wilson', service: 'Brake Maintenance', date: '2024-09-20', status: 'Pending' },
    { customer: 'Michael Brown', service: 'Battery Replacement', date: '2024-09-18', status: 'Completed' },
    { customer: 'Alice Johnson', service: 'Engine Repair', date: '2024-09-15', status: 'In Progress' },
];

const statusOptions = ['All', 'Pending', 'In Progress', 'Completed'];

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

const BookingList = () => {
    const [bookings, setBookings] = useState(initialBookings);
    const [filterStatus, setFilterStatus] = useState('All');
    const [sidebarOpen, setSidebarOpen] = useState(false);

    const filteredBookings = filterStatus === 'All' ? bookings : bookings.filter(b => b.status === filterStatus);

    const handleRemoveCompleted = () => {
        const remainingBookings = bookings.filter(b => b.status !== 'Completed');
        setBookings(remainingBookings);
    };

    const toggleSidebar = (open) => () => {
        setSidebarOpen(open);
    };

    return (
        <Box sx={{ backgroundColor: '#f0f0f0', minHeight: '100vh', padding: 3 }}>
         
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

            <Box sx={{ padding: 3, paddingLeft: 10 }}>
                <Typography variant="h4" align="center" gutterBottom sx={{ fontWeight: 'bold', marginBottom: 4 }}>
                    Manage Your Bookings
                </Typography>

                <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 4 }}>
                    <TextField
                        select
                        label="Filter by Status"
                        value={filterStatus}
                        onChange={(e) => setFilterStatus(e.target.value)}
                        sx={{ width: 200 }}
                        variant="outlined"
                    >
                        {statusOptions.map((option) => (
                            <MenuItem key={option} value={option}>
                                {option}
                            </MenuItem>
                        ))}
                    </TextField>

                    <Box sx={{ display: 'flex', alignItems: 'center' }}>
                        <IconButton
                            color="error"
                            onClick={handleRemoveCompleted}
                            sx={{ backgroundColor: '#f44336', '&:hover': { backgroundColor: '#d32f2f' }, color: '#fff' }}
                        >
                            <DeleteIcon />
                        </IconButton>
                    </Box>
                </Box>

                <Grid container spacing={4}>
                    {filteredBookings.map((booking, index) => (
                        <Grid item xs={12} sm={6} md={4} key={index}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom>
                                        {booking.customer}
                                    </Typography>
                                    <Typography variant="body1" gutterBottom>
                                        Service: {booking.service}
                                    </Typography>
                                    <Typography variant="body2" color="text.secondary">
                                        Date: {booking.date}
                                    </Typography>
                                    <Chip
                                        label={booking.status}
                                        color={booking.status === 'Completed' ? 'success' : booking.status === 'In Progress' ? 'warning' : 'default'}
                                        sx={{ marginTop: 2 }}
                                    />
                                </CardContent>
                            </Card>
                        </Grid>
                    ))}
                </Grid>
            </Box>
        </Box>
    );
};

export default BookingList;
