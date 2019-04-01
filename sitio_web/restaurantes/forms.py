from django import forms

class searchForm(forms.Form):
    nombre = forms.CharField(label='nombre', max_length=200)