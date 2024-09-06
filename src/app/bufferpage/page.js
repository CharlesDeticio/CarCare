import React from 'react';
import { Container, Typography, Card, CardContent, Button, Grid, Box, CardActions } from '@mui/material';
import PrecisionManufacturingIcon from '@mui/icons-material/PrecisionManufacturing';
import EmojiPeopleIcon from '@mui/icons-material/EmojiPeople';
import Avatar from '@mui/material/Avatar';


export default function BasicCard() {
  return (
    <Container sx={{ marginTop: 4,display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: '80vh' }}>
      <Grid container spacing={4} justifyContent="center">
        <Grid item xs={12} sm={6} md={4}>
          <Card sx={{ minWidth: 275, boxShadow: 6 }}>
          <CardContent>
            <Box sx={{ display: 'flex', justifyContent: 'center', mt: 2 }}>
              <Avatar sx={{ bgcolor: '#0d2a7c' }}>
                <EmojiPeopleIcon />
              </Avatar>
            </Box>
            <Typography variant="body2" sx={{display: 'flex', justifyContent: 'center', mt: 2, fontWeight: 'bold'}}>Are you a Customer?</Typography>
            </CardContent>
            <CardActions>
            <Button variant="contained" color="primary" type="submit" href="\cregistration" fullWidth >
            Register as Customer
          </Button>
            </CardActions>
          </Card>
        </Grid>

        <Grid item xs={12} sm={6} md={4}>
          <Card sx={{ minWidth: 275, boxShadow: 6 }}>
            <CardContent>
            <Box sx={{ display: 'flex', justifyContent: 'center', mt: 2 }}>
              <Avatar sx={{ bgcolor: '#0d2a7c' }}>
                <PrecisionManufacturingIcon />
              </Avatar>
            </Box>
            <Typography variant="body2" sx={{display: 'flex', justifyContent: 'center', mt: 2, fontWeight: 'bold'}}>Are you a Mechanic?</Typography>
            </CardContent>
            <CardActions>
            <Button variant="contained" color="primary" type="submit" href="\mregistration" fullWidth >
            Register as Mechanic
          </Button>
            </CardActions>
          </Card>
        </Grid>
      </Grid>
    </Container>
  );
}
