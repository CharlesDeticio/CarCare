'use client';
import React from 'react';
import { Container, Typography, Box, CardMedia, Card, CardContent, IconButton, AppBar, Toolbar, Avatar, Button, Grid, List, ListItem, ListItemIcon, ListItemText, Divider } from '@mui/material';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import PhoneIcon from '@mui/icons-material/Phone';
import BuildIcon from '@mui/icons-material/Build';
import { deepOrange } from '@mui/material/colors';

const logoUrl = "/assets/449769249_1217885939590873_7635439348389433262_n.png";

const CarShopDetails = () => {
    return (
        <Box sx={{ backgroundColor: '#f0f0f0', minHeight: '100vh', padding: 3 }}>
            <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' }}>
                <Toolbar>
                    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                        Car Shop Details
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
                <Card sx={{ display: 'flex', flexDirection: 'column', boxShadow: 3 }}>
                    <CardMedia
                        component="img"
                        height="400"
                        image="/assets/pic1.jpg"
                        alt="Car Shop"
                    />
                    <CardContent>
                        <Typography variant="h5" gutterBottom>
                            Premium Auto Repair
                        </Typography>
                        <Typography variant="body1" color="textSecondary" paragraph>
                            We provide top-quality repair and maintenance services for all car brands. Our expert technicians ensure your car receives the best care possible.
                        </Typography>

                        <Grid container spacing={2}>
                            <Grid item xs={12} md={6}>
                                <List>
                                    <ListItem>
                                        <ListItemIcon>
                                            <LocationOnIcon color="primary" />
                                        </ListItemIcon>
                                        <ListItemText primary="123 Street, CIty" />
                                    </ListItem>
                                    <ListItem>
                                        <ListItemIcon>
                                            <PhoneIcon color="primary" />
                                        </ListItemIcon>
                                        <ListItemText primary="+1 (222) 123-4567" />
                                    </ListItem>
                                </List>
                            </Grid>
                            <Grid item xs={12} md={6}>
                                <Typography variant="h6" gutterBottom>
                                    Services Offered:
                                </Typography>
                                <List>
                                    <ListItem>
                                        <ListItemIcon>
                                            <BuildIcon color="primary" />
                                        </ListItemIcon>
                                        <ListItemText primary="Engine Repair" />
                                    </ListItem>
                                    <ListItem>
                                        <ListItemIcon>
                                            <BuildIcon color="primary" />
                                        </ListItemIcon>
                                        <ListItemText primary="Brake Maintenance" />
                                    </ListItem>
                                    <ListItem>
                                        <ListItemIcon>
                                            <BuildIcon color="primary" />
                                        </ListItemIcon>
                                        <ListItemText primary="Oil Change" />
                                    </ListItem>
                                </List>
                            </Grid>
                        </Grid>
                        <Divider sx={{ my: 3 }} />

                        <Box sx={{ textAlign: 'center' }}>
                            <Button variant="contained" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }} size="large" href='/bookservice'>
                                Book a Service
                            </Button>
                        </Box>
                    </CardContent>
                </Card>
            </Container>
        </Box>
    );
};

export default CarShopDetails;
