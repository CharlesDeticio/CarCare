'use client';
import React, { useState } from 'react';
import { Box, Typography, Grid, Card, CardContent, Button, TextField, Switch, Avatar, FormControlLabel, IconButton, Drawer, List, ListItem, ListItemText, ListItemIcon, Divider, Container, FormGroup } from '@mui/material';
import { deepOrange } from '@mui/material/colors';
import MenuIcon from '@mui/icons-material/Menu';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import LogoutIcon from '@mui/icons-material/Logout';
import PeopleIcon from '@mui/icons-material/People';
import SettingsIcon from '@mui/icons-material/Settings';

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

const SettingsPage = () => {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [name, setName] = useState('Admin One');
    const [email, setEmail] = useState('admin1@carcare.com');
    const [password, setPassword] = useState('');
    const [notificationsEnabled, setNotificationsEnabled] = useState(true);
    const [twoFactorAuth, setTwoFactorAuth] = useState(false);

    const handleSaveProfile = () => {
        console.log('Profile settings saved:', { name, email, password });
    };

    const handleSaveSecurity = () => {
        console.log('Security settings saved:', { twoFactorAuth });
    };

    const handleSaveNotifications = () => {
        console.log('Notification preferences saved:', { notificationsEnabled });
    };

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
                        Settings
                    </Typography>

                    <Grid container spacing={4}>
                        {/* Profile Section */}
                        <Grid item xs={12} md={6}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom sx={{ color: '#1141c1' }}>
                                        Profile Settings
                                    </Typography>

                                    <TextField
                                        label="Name"
                                        variant="outlined"
                                        fullWidth
                                        margin="normal"
                                        value={name}
                                        onChange={(e) => setName(e.target.value)}
                                    />
                                    <TextField
                                        label="Email"
                                        variant="outlined"
                                        fullWidth
                                        margin="normal"
                                        value={email}
                                        onChange={(e) => setEmail(e.target.value)}
                                    />
                                    <TextField
                                        label="Password"
                                        type="password"
                                        variant="outlined"
                                        fullWidth
                                        margin="normal"
                                        value={password}
                                        onChange={(e) => setPassword(e.target.value)}
                                    />
                                    <Button
                                        variant="contained"
                                        sx={{ backgroundColor: '#1141c1', color: 'white', marginTop: 2 }}
                                        fullWidth
                                        onClick={handleSaveProfile}
                                    >
                                        Save Profile
                                    </Button>
                                </CardContent>
                            </Card>
                        </Grid>

                        {/* Security Section */}
                        <Grid item xs={12} md={6}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom sx={{ color: '#1141c1' }}>
                                        Security Settings
                                    </Typography>

                                    <FormGroup>
                                        <FormControlLabel
                                            control={
                                                <Switch
                                                    checked={twoFactorAuth}
                                                    onChange={(e) => setTwoFactorAuth(e.target.checked)}
                                                />
                                            }
                                            label="Enable Two-Factor Authentication"
                                        />
                                    </FormGroup>

                                    <Button
                                        variant="contained"
                                        sx={{ backgroundColor: '#1141c1', color: 'white', marginTop: 2 }}
                                        fullWidth
                                        onClick={handleSaveSecurity}
                                    >
                                        Save Security Settings
                                    </Button>
                                </CardContent>
                            </Card>
                        </Grid>

                        {/* Notifications Section */}
                        <Grid item xs={12} md={6}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom sx={{ color: '#1141c1' }}>
                                        Notification Preferences
                                    </Typography>

                                    <FormGroup>
                                        <FormControlLabel
                                            control={
                                                <Switch
                                                    checked={notificationsEnabled}
                                                    onChange={(e) => setNotificationsEnabled(e.target.checked)}
                                                />
                                            }
                                            label="Enable Email Notifications"
                                        />
                                    </FormGroup>

                                    <Button
                                        variant="contained"
                                        sx={{ backgroundColor: '#1141c1', color: 'white', marginTop: 2 }}
                                        fullWidth
                                        onClick={handleSaveNotifications}
                                    >
                                        Save Notification Preferences
                                    </Button>
                                </CardContent>
                            </Card>
                        </Grid>

                        {/* App Configuration Section */}
                        <Grid item xs={12} md={6}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom sx={{ color: '#1141c1' }}>
                                        Application Configuration
                                    </Typography>

                                    <TextField
                                        label="App Title"
                                        variant="outlined"
                                        fullWidth
                                        margin="normal"
                                        value="CarCare Service Center"
                                    />
                                    <TextField
                                        label="Timezone"
                                        variant="outlined"
                                        fullWidth
                                        margin="normal"
                                        value="GMT"
                                    />
                                    <Button
                                        variant="contained"
                                        sx={{ backgroundColor: '#FF6B35', color: 'white', marginTop: 2 }}
                                        fullWidth
                                    >
                                        Save App Configuration
                                    </Button>
                                </CardContent>
                            </Card>
                        </Grid>
                    </Grid>
                </Container>
            </Box>
        </Box>
    );
};

export default SettingsPage;
