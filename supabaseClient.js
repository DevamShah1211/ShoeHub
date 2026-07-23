// Supabase Client Initialization for ShoeHub
// Replace the URL and Anon Key below with your actual Supabase project credentials.
// Find them in your Supabase Dashboard under: Project Settings -> API.

const SUPABASE_URL = window.ENV_SUPABASE_URL || 'YOUR_SUPABASE_URL';
const SUPABASE_ANON_KEY = window.ENV_SUPABASE_ANON_KEY || 'YOUR_SUPABASE_ANON_KEY';

// If using in browser via script tag:
// <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
const supabase = window.supabase ? window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY) : null;

export { supabase, SUPABASE_URL, SUPABASE_ANON_KEY };
