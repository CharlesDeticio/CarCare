import React from 'react';
import { Container, Typography, TextField, Button, Box, AppBar, Toolbar, Link, Grid } from '@mui/material';
import Checkbox from '@mui/material/Checkbox';

const label = { inputProps: { 'aria-label': 'Checkbox demo' } };

const LoginPage = () => {
  
  

  return (
    <>
      

      <Container sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: '80vh' }}>
        <Box
          component="form"
        
          sx={{
            width: 400,
            padding: 4,
            backgroundColor: '#fff',
            borderRadius: 2,
            boxShadow: 3,
            textAlign: 'center',
          }}
        >
          <Typography variant="h4" gutterBottom sx={{ marginBottom: 4 ,fontWeight: 'bold'}}>
            LOGIN
          </Typography>

          <TextField
            label="Username"
            variant="outlined"
            fullWidth
        
            sx={{ marginBottom: 2 }}
          />
          <TextField
            label="Password"
            variant="outlined"
            type="password"
            fullWidth
       
            sx={{ marginBottom: 4 }}
          />
          
          <Button variant="contained" color="primary" type="submit" href="\dashboard" fullWidth >
            LOGIN
          </Button>
          <Grid container alignItems="center" sx={{ marginTop: 1 }}>
            <Grid item>
              <Checkbox {...label} />
            </Grid>
            <Grid item>
              <Typography variant="body2" sx={{fontWeight: 'bold'}}>Keep me Login</Typography>
            </Grid>
          </Grid>
          <Typography sx={{padding: 2}}><Link>Forgot Password?</Link></Typography>
          <Typography variant="body2" sx={{ marginTop: 2 }}>
            Don't have an account?{' '}
            <Link href="/bufferpage" color="secondary">
              Register here
            </Link>
          </Typography>

        </Box>
      </Container>
    </>
  );
};

export default LoginPage;
