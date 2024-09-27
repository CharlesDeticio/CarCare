'use client';
import React, { useState } from 'react';
import { Container, Typography, Box, AppBar, Toolbar, Avatar, IconButton, TextField, Button, Grid, MenuItem, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle, Card, CardMedia, CardContent } from '@mui/material';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import { deepOrange } from '@mui/material/colors';

const services = [
    { label: 'Oil Change', value: 'oil-change' },
    { label: 'Brake Maintenance', value: 'brake-maintenance' },
    { label: 'Engine Repair', value: 'engine-repair' },
    { label: 'Tire Rotation', value: 'tire-rotation' },
];

const BookService = () => {
    const [selectedService, setSelectedService] = useState('');
    const [date, setDate] = useState('');
    const [time, setTime] = useState('');
    const [comments, setComments] = useState('');
    const [open, setOpen] = useState(false);

    const handleConfirm = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const handleSubmit = () => {
        setOpen(false);
        console.log('Service Booked:', { selectedService, date, time, comments });
    };

    return (
        <Box sx={{ backgroundColor: '#f0f0f0', minHeight: '100vh', padding: 3 }}>
            <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' }}>
                <Toolbar>
                    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                        Book a Service
                    </Typography>
                    <IconButton color="inherit" sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <HomeIcon />
                    </IconButton>
                    <IconButton color="inherit" sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <EventNoteIcon />
                    </IconButton>
                    <IconButton color="inherit" href='/cart' sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}>
                        <ShoppingCartIcon />
                    </IconButton>
                    <Avatar sx={{ bgcolor: deepOrange[500] }} href='/userprofile'>N</Avatar>
                </Toolbar>
            </AppBar>

            <Container sx={{ marginTop: 4 }}>
                <Typography variant="h4" align="center" gutterBottom sx={{ marginTop: 6, marginBottom: 6, backgroundColor: '#f3f3f3', fontFamily: 'Arial', fontWeight: 'bold' }}>
                    Book a Service with CarCare
                </Typography>

                <Grid container spacing={4} alignItems="center">
                    {/* Left: Shop Image */}
                    <Grid item xs={12} md={6}>
                        <Card sx={{ boxShadow: 3 }}>
                            <CardMedia
                                component="img"
                                alt="Shop Image"
                                height="300"
                                image="/assets/pic1.jpg"
                            />
                            <CardContent>
                                <Typography variant="h6" color="textSecondary">
                                    General Car Repair Shop
                                </Typography>
                                <Typography variant="body2" color="textSecondary">
                                    Address: 123 Main St, City, State
                                </Typography>
                            </CardContent>
                        </Card>
                    </Grid>

                    {/* Right: Booking Form */}
                    <Grid item xs={12} md={6}>
                        <Card sx={{ padding: 4, boxShadow: 3 }}>
                            <Typography variant="h5" gutterBottom>
                                Book Your Service
                            </Typography>

                            <Grid container spacing={3}>
                                <Grid item xs={12}>
                                    <TextField
                                        select
                                        label="Select Service"
                                        fullWidth
                                        value={selectedService}
                                        onChange={(e) => setSelectedService(e.target.value)}
                                        variant="outlined"
                                        helperText="Please choose a service"
                                    >
                                        {services.map((option) => (
                                            <MenuItem key={option.value} value={option.value}>
                                                {option.label}
                                            </MenuItem>
                                        ))}
                                    </TextField>
                                </Grid>
                                <Grid item xs={6}>
                                    <TextField
                                        label="Select Date"
                                        type="date"
                                        fullWidth
                                        value={date}
                                        onChange={(e) => setDate(e.target.value)}
                                        variant="outlined"
                                        InputLabelProps={{ shrink: true }}
                                    />
                                </Grid>
                                <Grid item xs={6}>
                                    <TextField
                                        label="Select Time"
                                        type="time"
                                        fullWidth
                                        value={time}
                                        onChange={(e) => setTime(e.target.value)}
                                        variant="outlined"
                                        InputLabelProps={{ shrink: true }}
                                    />
                                </Grid>
                                <Grid item xs={12}>
                                    <TextField
                                        label="Additional Comments"
                                        multiline
                                        rows={3}
                                        fullWidth
                                        value={comments}
                                        onChange={(e) => setComments(e.target.value)}
                                        variant="outlined"
                                    />
                                </Grid>
                            </Grid>

                            <Box sx={{ textAlign: 'center', marginTop: 4 }}>
                                <Button
                                    variant="contained"
                                    sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}
                                    size="large"
                                    onClick={handleConfirm}
                                >
                                    Confirm Booking
                                </Button>
                            </Box>
                        </Card>
                    </Grid>
                </Grid>
            </Container>

            <Dialog open={open} onClose={handleClose}>
                <DialogTitle>Confirm Booking</DialogTitle>
                <DialogContent>
                    <DialogContentText>You are about to book the following service:</DialogContentText>
                    <Typography variant="body1"><strong>Service:</strong> {selectedService}</Typography>
                    <Typography variant="body1"><strong>Date:</strong> {date}</Typography>
                    <Typography variant="body1"><strong>Time:</strong> {time}</Typography>
                    <Typography variant="body1"><strong>Comments:</strong> {comments || 'None'}</Typography>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose} color="secondary">Cancel</Button>
                    <Button onClick={handleSubmit} sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }} variant="contained">Confirm</Button>
                </DialogActions>
            </Dialog>
        </Box>
    );
};

export default BookService;
