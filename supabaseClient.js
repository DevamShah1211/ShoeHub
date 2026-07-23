// Supabase Client Initialization for ShoeHub
// Replace the URL and Anon Key below with your actual Supabase project credentials.
// Find them in your Supabase Dashboard under: Project Settings -> API.

const SUPABASE_URL = 'https://abvogxuydegfuavqpeoc.supabase.co';
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFidm9neHV5ZGVnZnVhdnFwZW9jIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODQ4MDAxMzMsImV4cCI6MjEwMDM3NjEzM30.QlLjvLNbSB1loEfmn2x-aLKc748xkZY-YvXEX7y-RDE';

// If using in browser via script tag:
// <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
const supabase = window.supabase ? window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY) : null;

export { supabase, SUPABASE_URL, SUPABASE_ANON_KEY };
